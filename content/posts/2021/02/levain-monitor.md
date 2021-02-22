+++
layout =    "single"
type =      "blog"

date =      2021-02-21T08:36:18-08:00
draft =     true

title =     "Precision Sourdough Starter: An IoT Smart Lid"
tagline =   "Taking the guess work out of baking sourdough bread."
image =     "/imgs/blog-imgs/sourdough-starter-monitor-lid/levain-monitor-combined.png"
tags =      ["3d-printing", "design", "electrical", "programming", "embedded"]

aliases =   []
+++

# The Backstory

A few years ago, I had the idea to [track my sourdough starter using computer vision]({{< ref "/posts/2018/06/sourdough-starter-monitor" >}}). It was neat to monitor it this way, but it was fairly impractical to do for each feeding since it required setting up a camera, downloading the images, and doing some manual image cropping before running it through my analysis script. The analysis was also only done after the fact, and what I really wanted was something that could tell me when the starter is ready to be used (or fed), or if I missed the window of opportunity, how long ago it peaked.

Last year, I came across [this Reddit thread](https://www.twilio.com/blog/sourd-io-is-a-fitness-tracker-for-your-sourdough-starter) and [Christine Sunu's sourd.io project](https://www.twilio.com/blog/sourd-io-is-a-fitness-tracker-for-your-sourdough-starter), where they both had distance sensors inside the lid to measure the height of the starter. I thought it was genius, and had to make one for myself! However, in addition to the live monitoring, I wanted to log the data for further analysis, so I also decided to make it internet-connected as a way to get the data off the device (since saving to an SD card adds hardware costs, as well as being less "sexy" in today's world of everything having wifi connectivity).

This project definitely took longer than I originally expected... And since I'm only human, I had spouts of project fatigue where I had grains of motivation to work on this anymore. Fortunately, a burst of inspiration came to me over the Christmas break, and I managed to finish the last remaining bits of this project. I'm glad I did, because it turned out to be one of the more nifty gadgets I put together!

If you're only interested in the resulting data that came out of this, you can skip to [the end](#the-analysis) where I visualize the growth, temperature, and humidity from a few weeks of worth of feedings.

Interested in making your own? All the design files and code can be found on [GitHub](https://github.com/justinmklam/iot-sourdough-starter-monitor).

{{<img caption="Three modes of operation: Max rise and time, graph, stats for nerds." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/jar.gif" >}}
{{<img caption="Selecting, viewing, and downloading data for a given feeding session." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/webapp.gif" >}}

# The Development

## Hardware

### Electronics

With the idea in mind, I bought the components off Digikey and Aliexpress and hooked them up on a breadboard. I wrote some code to test that all components worked correctly, then went on to design a PCB to make integrating it into a lid form factor easier.

{{<img caption="Breadboard prototype with off-the-shelf modules." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/IMG_1513.jpg" >}}

I've made PCBs using protoboards before (in my [sous vide controller]({{< ref "/posts/2017/05/sous-vide-controller#the-controller" >}})), but it was extremely time consuming. Since I got over the learning curve of using Kicad, now I'd rather wait a few weeks for the boards to show up from overseas, especially since it's so cheap ($2 for 5 boards, plus $14 shipping).

{{<img caption="PCB layout and schematic, designed in Kicad." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/kicad.png" >}}
{{<img caption="Assembled PCB." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/pcb.png" >}}

At this point, I was eager to try it out, so I cut a hole in a plastic yogurt lid and taped the assembled PCB on.

{{<img caption="It ain't pretty, but it works." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/IMG_1618.jpg" >}}

It worked well enough to test out the initial workflow, and I realized that I needed few crucial things:

- The height of the jar
- The starting height of the starter
- The height the starter has grown

With a bit of algebra and math, these values can be calculated with the distance sensor at the bottom of the lid.

{{<img caption="Algebra? More like alge-bread!" src="/imgs/blog-imgs/sourdough-starter-monitor-lid/diagram.jpeg" >}}

Some definitions:

$$ d_1 = distance \\ to \\ jar $$
$$ d_2 = distance \\ to \\ starting \\ height $$
$$ d_3 = distance \\ to \\ current \\ height $$

$$ h_1 = starting \\ height $$
$$ h_2 = current \\ height $$

And the governing equations:

$$ h_1 = d_1 - d_2 $$
$$ h_2 = d_2 - d_3 $$
$$ h_{rise percent} = h_2 / h_1 = (d_2 - d_3) / (d_1 - d_2) $$

### Enclosure

I designed the enclosure in Fusion 360 and printed it on my [Monoprice Mini 3D Printer]({{< ref "/posts/2017/03/mp-select-mini" >}}).

{{<img caption="3D printed enclosure, designed in Fusion 360." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/fusion 360.png" >}}

It was honestly not a great design, since I had to resort to using hot glue to attach the PCB to the enclosure, mainly because I forgot to leave enough hole clearance on the PCB . Ideally, the PCB would mount into the top half (instead of the bottom half, as designed), but unfortunately I didn't have this forethought and there weren't any features to easily mount to the ESP8266 or display.


{{<img caption="Yes, that's a machine screw hot glued on to a switch..." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/IMG_4185.jpg" >}}
Since I didn't want to solder the modules directly on to the PCB, I used female headers to keep them removable. However, this gave the assembly quite a bit of height, which resulted in the button needing some type of extension. I didn't want to make another Digikey order specifically for this button, so I decided to be resourceful and glued a machine screw to the button to make up for the missing height.

Anyway, it assembled together without issues, and the only mistake you can see from the outside is the screw head (or let's just say I wanted to go for an intentional steampunk look).

{{<img caption="An active, healthy starter being carefully monitored." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/jar2.jpg" >}}

## Firmware

I wanted to use a task-based architecture, since having everything in a single state machine can become convoluted and difficult to debug. With multitasking, the processor is only executing a single task at any given time, but it switches between each task rapidly to give the illusion of concurrency. I've used FreeRTOS before, but wanted something more lightweight since I didn't need all the bells and whistles that it provides.

{{<img caption="Multitasking vs concurrency" link="https://www.freertos.org/implementation/a00004.html" link-text="FreeRTOS" src="/imgs/blog-imgs/sourdough-starter-monitor-lid/TaskExecution.gif" >}}

I eventually came across [TaskScheduler](https://github.com/arkhipenko/TaskScheduler), a cooperative multitasking framework, which checked all the boxes I needed.

{{<img caption="A lightweight implementation of cooperative multitasking by TaskScheduler." link="https://github.com/arkhipenko/TaskScheduler" link-text="GitHub" src="/imgs/blog-imgs/sourdough-starter-monitor-lid/TaskScheduler_html.png" >}}

The code was divided up as follows:

- **measurements.cpp** - Read the sensors and make the measurements available for other tasks
- **userinput.cpp** - Handle the button presses from user input (short press, long press, double click)
- **display.cpp** - Display information to the user
- **iot.cpp** - Send the measured data to the cloud

The benefit of this architecture is that each file is less than 200 lines of code, and the clear separation of concerns made it easy to develop and debug.

{{<img caption="The display shows how much it peaked, and how much time elapsed since it peaked." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/jar1.jpg" >}}

The firmware itself was fairly straightforward. The only "fancy" thing I needed to do was save the jar height to EEPROM so that it's saved between sessions, even if it's powered off. However, the ESP8266 doesn't actually have genuine EEPROM memory, so it's emulated by using a section of flash memory.

## Cloud Connectivity

The most annoying part of this project was actually getting AWS set up on the ESP8266. I encountered many library compatibility issues, which I should have expected since this chip was released 6 years ago (at the time of development). If I didn't have an ESP8266 in my box of parts that I wanted to use, I would have used the newer ESP32. If you're looking for a minimal example, you can check out the template I made on [GitHub](https://github.com/justinmklam/aws-iot-esp266-demo).

Once I got it publishing messages over MQTT to AWS, I set up the cloud infrastructure to receive and save the data. The data flow is:

1. Device sends the data in a message over MQTT
2. On a message receive event, an [AWS Lambda](https://aws.amazon.com/lambda/) function is triggered to parse the data from the message and passes it to a [Kinesis Firehose](https://aws.amazon.com/kinesis/data-firehose/) delivery stream
2. Kinesis Firehose receives the data and saves it [Amazon S3](https://aws.amazon.com/s3/)

{{<img caption="AWS architecture for basic IoT applications." link="https://dzone.com/articles/design-practices-aws-iot-solutions-volansys" link-text="DZone" src="/imgs/blog-imgs/sourdough-starter-monitor-lid/aws-iot.png" >}}

I initially was going to use [Amazon QuickSight](https://aws.amazon.com/quicksight/) to visualize the data, but there were limitations with the refresh rate that were a deal breaker for me. I bit the bullet and created a custom dashboard using [Flask](https://flask.palletsprojects.com/), which queries data from S3 using [Amazon Athena](https://aws.amazon.com/athena/). I was too lazy to figure out how to host the dashboard on AWS for free, so I opted to use [Heroku](https://www.heroku.com/) (as I've done previously for my [recipe converter web app](https://github.com/justinmklam/recipe-converter)).

With cloud connectivity and dashboard complete, the sourdough monitor is now ready to be used!

# The Analysis

The main purpose of the monitor was to help with my timing of when to use the starter. Since the data was being collected anyway, I figured I might as well do some analysis to see if there was anything significant.

## Overview

After using the monitor for a few weeks, I had enough data to play with. The two main things I was curious about were:

1. Whether the peak height changes over time (i.e. through repeated feedings)
2. If it still grew as much if the starter was kept in the fridge and hadn't been fed for a few days

Doing a quick kernel density plot to get a feel for the data, we see some clustering but no obvious trends.

{{<img caption="Kernel density plot to show the distribution and clustering of data. No clear correlations are present..." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/kde-plot.png" >}}

The graph below shows the consistency of my feedings:

- 5 subsequent feedings, starting on Jan 21
- 3 subsequent feedings on Jan 30, Feb 3, and Feb 17
- 2 subsequent feedings on Feb 12

*Note: The horizontal axis is a bit off since some days had multiple feedings, the graph assumes each feeding is a separate day.*

{{<img caption="Feeding schedule over the past few weeks." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/max-rise-over-time.png" >}}

The graph below shows no correlation between how long it took for the peak rise to occur. It also didn't seem to matter if the starter was kept in the fridge for a few days, which is great news (and maybe not news to those who know their starter well)!

{{<img caption="No statistical significance between the most relevant metrics." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/regression.png" >}}

## In Detail

Looking at the time series data, we see that the progression of the rise height from the first to last feeding. Interestingly, the slope remains constant, even if the starter has been dormant for a few days.

Keep in mind that I used a temperature controlled proofing box, which is why the temperature and humidity are constant throughout the majority of the fermentation.

<!-- {{<img caption="TEXT" src="/imgs/blog-imgs/sourdough-starter-monitor-lid/combined.png" >}} -->

{{<img caption="Rise height, temperature, and humidity over time." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/feeding.png" >}}
{{<img caption="Pair plot of the time series. Not much to show, except that temperature and humidity are correlated (as expected)." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/pairplot.png" >}}

{{<img caption="Visualization of the rest of the feeding data, for those interested." src="/imgs/blog-imgs/sourdough-starter-monitor-lid/all-combined.png" >}}

# Conclusion

{{<img caption="A darn nice crumb, if I do say so myself!" src="/imgs/blog-imgs/sourdough-starter-monitor-lid/bread.jpg" >}}
