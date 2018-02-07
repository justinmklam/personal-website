+++
date = "2018-02-03T17:02:25-08:00"
draft = true
image = "/imgs/blog-imgs/ping-sweeper/banner2.PNG"
layout = "single-blog"
tagline = "Life is better when you live asynchronously."
tags = ["programming", "c sharp"]
title = "Synchronous vs Asynchronous Ping Sweep in C# Windows Form"
type = "blog"

+++

As a mechatronics engineer (in training), sometimes I like to pretend that I also know how to program. 

[^*]: Engineer in Training. EGBC please don't take my license away.

In my most recent adventures to software land at [MistyWest](https://mistywest.com/), I needed to write an application in C# that involved doing a ping sweep to find devices that were physically connected through ethernet. Since Google and Stack Overflow are my two best friends, I was able to find (what seemed to be) an off-the-net solution quite quickly. 

However, despite this being a relatively well known objective with well-known libraries to accomplish it, my journey to developing a solution was not as easy as I originally thought. The following post outlines the things I tried before arriving to a working solution, which hopefully is at least mildly interesting and/or educational. Also if you're a software engineer reading this, please go easy on my code. Or not.

### First Attempt: Some-ping Simple

A quick Google search showed that pinging addresses is dead simple in C#. Using the `System.Net.NetworkInformation` namespace, we can easily use the `Ping.Send()` command to check if a remote address is alive. 

```c#
using System.Net.NetworkInformation;

int timeout = 10;   //in ms

Ping p = new Ping();
PingReply rep = p.Send("192.168.1.1", timeout);

if (rep.Status == IPStatus.Success)
{
    //host is active
}
```

This is great if we only had a few addresses to ping, because unfortunately this method is unacceptably slow for a user waiting to see if any devices are found. Although `Ping.Send` has an overload to accept a timeout interval, it appears that setting very low values doesn't actually change much. From the [MSDN docs](https://msdn.microsoft.com/en-us/library/ms144955.aspx):

> When specifying very small numbers for timeout, the Ping reply can be received even if timeout milliseconds have elapsed.

In practice, it seems that ~500ms is about the fastest threshold that can be set. Unfortunately, scanning 255 IP addresses this way will be excruciatingly slow (for both the developer and end user). And the search continues...

### Second Attempt: Jaime LAN-nister, Pingslayer

A few more Googles later and I had what seemed to be the golden solution.

Thanks to [Tim Coker](https://stackoverflow.com/a/4042887), I thought I was mostly done my application already (knowledge is half the battle, right?). His console application worked wonderfully and was written in C#, which was great news since I was developing the application using Windows Forms. Instead of using the synchronous `Ping.Send()`, it harnessed the asynchronous `Ping.SendAsync()` along with the `CountdownEvent` class in `System.Threading`. However, upon copying the code into Windows Forms, it didn't seem to work. What gives?

```csharp
/* Source: https://stackoverflow.com/a/4042887
 * Original author: Tim Coker
 */

using System;
using System.Diagnostics;
using System.Threading;
using System.Net.NetworkInformation;

namespace ConsoleApplication1
{
    class Program
    {
        static CountdownEvent countdown;
        static int upCount = 0;
        static object lockObj = new object();
        const bool resolveNames = true;

        static void Main(string[] args)
        {
            countdown = new CountdownEvent(1);
            Stopwatch sw = new Stopwatch();
            sw.Start();
            string ipBase = "10.22.4.";
            for (int i = 1; i < 255; i++)
            {
                string ip = ipBase + i.ToString();

                Ping p = new Ping();
                p.PingCompleted += new PingCompletedEventHandler(p_PingCompleted);
                countdown.AddCount();
                p.SendAsync(ip, 100, ip);
            }
            countdown.Signal();
            countdown.Wait();
            sw.Stop();
            TimeSpan span = new TimeSpan(sw.ElapsedTicks);
            Console.WriteLine("Took {0} milliseconds. {1} hosts active.", sw.ElapsedMilliseconds, upCount);
            Console.ReadLine();
        }

        static void p_PingCompleted(object sender, PingCompletedEventArgs e)
        {
            string ip = (string)e.UserState;
            if (e.Reply != null && e.Reply.Status == IPStatus.Success)
            {
                Console.WriteLine("{0} is up: ({1} ms)", ip, e.Reply.RoundtripTime);
                lock(lockObj)
                {
                    upCount++;
                }
            }
            else if (e.Reply == null)
            {
                Console.WriteLine("Pinging {0} failed. (Null Reply object?)", ip);
            }
            countdown.Signal();
        }
    }
}
```

Apparently, console applications and Windows Forms are different beasts and deadlocks occur with the above code. According to [Hans Passant from another Stack Overflow thread](https://stackoverflow.com/a/7767632), the additional UI thread is the culprit:

> Winforms has a synchronization provider whereas console apps do not. The problem is that the `Ping` class makes a best effort to raise the `PingCompleted` event on the same thread that calls `SendAsync()`. So it tries to raise the event on the main thread, but that can't work since the main thread is blocked with the `countdown.Wait()` call. In a console app however, the `PingCompleted` event will be raised on a `ThreadPool` thread.

Hm, turns out this problem wasn't as easy as copying and pasting random code off the internet. It also turns out that there are two different asynchronous ping methods in the same class. First on the list:

> `Ping.SendAsync`: **Asynchronously attempts** to send an Internet Control Message Protocol (ICMP) echo message to a computer, and receive a corresponding ICMP echo reply message from that computer. - [MSDN](https://msdn.microsoft.com/en-us/library/system.net.networkinformation.ping.sendasync(v=vs.110).aspx)

And the second:

> `Ping.SendPingAsync`: Sends an Internet Control Message Protocol (ICMP) echo message to a computer, and receives a corresponding ICMP echo reply message from that computer **as an asynchronous operation**. - [MSDN](https://msdn.microsoft.com/en-us/library/system.net.networkinformation.ping.sendpingasync(v=vs.110).aspx)

Doing a bit more research, a came across the `BackgroundWorker` class that's built into C# Winforms. However, it wasn't clear to me how `Ping.SendPingAsync()` would be dealt with in a single background thread. Although it wouldn't be on the UI thread, it seemed like each ping would need its own background thread to be truly asynchronous, which seemed like a clunky implementation...

### Third Attempt: One Ping to Rule Them All, One Ping to Find Them

https://stackoverflow.com/questions/13406901/task-parallel-library-code-freezes-in-a-windows-forms-application-works-fine-a


<!-- {{<img caption="Simple Winform application to demonstrate the power of threads." src="/imgs/blog-imgs/ping-sweeper/winform.png" >}} -->

Introducing the `Task` class in `System.Threading.Tasks`! This was the cleanest (and easiest) method to integrate with `Ping

```c#
private string BaseIP = "192.168.1.";
private int StartIP = 1;
private int StopIP = 255;
private string ip;

private int timeout = 100;
private int nFound = 0;

static object lockObj = new object();
Stopwatch stopWatch = new Stopwatch();
TimeSpan ts;

public async void RunPingSweep_Async()
{
    nFound = 0;

    var tasks = new List<Task>();

    stopWatch.Start();

    for (int i = StartIP; i <= StopIP; i++)
    {
        ip = BaseIP + i.ToString();

        System.Net.NetworkInformation.Ping p = new System.Net.NetworkInformation.Ping();
        var task = PingAndUpdateAsync(p, ip);
        tasks.Add(task);
    }

    await Task.WhenAll(tasks);

    stopWatch.Stop();
    ts = stopWatch.Elapsed;
    MessageBox.Show(nFound.ToString() + " devices found! Elapsed time: " + ts.ToString(), "Single Threaded");
}

private async Task PingAndUpdateAsync(System.Net.NetworkInformation.Ping ping, string ip)
{
    var reply = await ping.SendPingAsync(ip, timeout);

    if (reply.Status == System.Net.NetworkInformation.IPStatus.Success)
    {
        lock(lockObj)
        {
            nFound++;
        }
    }
}
```
{{<img caption="Asynchronous pings are light years faster! Half a second and we're rocking with all the pings we needed." src="/imgs/blog-imgs/ping-sweeper/ping result - async.png" >}}

#### Synchronous Ping Sweep

Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

```c#
private string BaseIP = "192.168.1.";
private int StartIP = 1;
private int StopIP = 255;
private string ip;

private int timeout = 100;
private int nFound = 0;

Stopwatch stopWatch = new Stopwatch();
TimeSpan ts;

public void RunPingSweep_Sync()
{
    nFound = 0;

    stopWatch.Start();
    System.Net.NetworkInformation.Ping p = new System.Net.NetworkInformation.Ping();

    for (int i = StartIP; i <= StopIP; i++)
    {
        ip = BaseIP + i.ToString();
        System.Net.NetworkInformation.PingReply rep = p.Send(ip, timeout);

        if (rep.Status == System.Net.NetworkInformation.IPStatus.Success)
        {
            nFound++;
        }
    }

    stopWatch.Stop();
    ts = stopWatch.Elapsed;

    MessageBox.Show(nFound.ToString() + " devices found! Elapsed time: " + ts.ToString(), "Single Threaded");
}
```

{{<img caption="Result of 255 pings using a synchronous method. Nobody has 2 minutes to wait for a complete scan." src="/imgs/blog-imgs/ping-sweeper/ping result - sync.png" >}}


```
$ nmap -sP 192.168.1.1-255
...
Nmap done: 255 IP addresses (15 hosts up) scanned in 34.73 seconds
```

Check out the full source code on [Github](https://github.com/justinmklam/ping-sweeper/blob/master/Ping%20Sweep%20Demo/Ping%20Sweep%20Demo/FormMain.cs).