+++
date = "2018-02-03T17:02:25-08:00"
draft = false
image = "/imgs/blog-imgs/ping-sweeper/banner2.PNG"
layout = "single-blog"
tagline = "Life is better when you live asynchronously."
tags = ["programming", "c sharp"]
title = "Synchronous Vs Asynchronous Ping Sweep in C# Windows Form"
type = "blog"

+++

As a mechatronics engineer[^*], sometimes I like to pretend to also know how to program. 

[^*]: Engineer in Training. EGBC please don't take my license away.

In my most recent adventures to software land at [MistyWest](https://mistywest.com/), I needed to write an application in C# that involved doing a ping sweep to find any connected devices. Since Google and Stack Overflow are my two best friends, I was able to find an off-the-net solution quite quickly. Additionally, this is a relatively well known objective so there are obvious libraries and methods to accomplish it.

### First Attempt: Some-Ping is Too Slow

Using the `System.Net.NetworkInformation` namespace, we can easily use the `Ping` class and its `Send` command to check if a remote address is alive. 

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

However, from the [MSDN Documentation](https://msdn.microsoft.com/en-us/library/ms144955.aspx) for `Ping.Send`, it appears that setting very fast timeouts doesn't actually change much.

> When specifying very small numbers for timeout, the Ping reply can be received even if timeout milliseconds have elapsed.

In practice, it seems that ~500ms is about the fastest threshold that can be set. Unfortunately, scanning 255 IP addresses this way will be excruciatingly slow (for both the developer and end user). And the search continues...

### Second Attempt: Jaime LAN-nister, Pingslayer

Thanks to [Tim Coker](https://stackoverflow.com/a/4042887), I thought I was mostly done my application already (knowledge is half the battle, right?). The console application worked wonderfully and was written in C#, which was great news since I was developing the application using Windows Forms. However, upon copying the code into Windows Forms, it didn't seem to work. What gives?

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

It turns out that `System.Net.NetworkInformation.Ping`

### Third Attempt: One Ping to Rule Them All

{{<img caption="Simple Winform application to demonstrate the power of threads." src="/imgs/blog-imgs/ping-sweeper/winform.png" >}}

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

#### Asynchronous Ping Sweep

Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

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
{{<img caption="Asynchronous pings are light years faster! Half a second and we're rocking." src="/imgs/blog-imgs/ping-sweeper/ping result - async.png" >}}

```
$ nmap -sP 192.168.1.1-255
...
Nmap done: 255 IP addresses (15 hosts up) scanned in 34.73 seconds
```

Check out the full source code on [Github](https://github.com/justinmklam/ping-sweeper/blob/master/Ping%20Sweep%20Demo/Ping%20Sweep%20Demo/FormMain.cs).