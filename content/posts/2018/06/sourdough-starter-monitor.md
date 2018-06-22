+++
date = "2018-05-25T17:50:22-07:00"
draft = true
image = "/imgs/blog-imgs/sourdough-starter-monitor/Crumb comparison.png"
layout = "single-blog"
tagline = "Something something insert crumby bread pun here."
tags = ["programming", "python", "image analysis"]
title = "Using Computer Vision to Monitor Yeast Fermentation"
type = "blog"

+++

# The Backstory
Blah blah blah

# The Development

## Setting Up Headless Raspberry Pi

### Headless Mode

Source: [raspberrypi.org](https://www.raspberrypi.org/forums/viewtopic.php?t=191252)

Step 1: Create an empty file. You can use Notepad on Windows or TextEdit to do so by creating a new file. Just name the file `ssh`. Save that empty file and dump it into boot partition (microSD).

Step 2: Create another file name `wpa_supplicant.conf`. This time you need to write a few lines of text for this file. For this file, you need to use the FULL VERSION of wpa_supplicant.conf. Meaning you must have the 3 lines of data namely country, ctrl_interface and update_config

> If a wpa_supplicant.conf file is placed into the /boot/ directory, this will be moved to the /etc/wpa_supplicant/ directory the next time the system is booted, overwriting the network settings; this allows a Wifi configuration to be preloaded onto a card from a Windows or other machine that can only see the boot partition. 
> 
> — The latest update to Raspbian - Raspberry Pi, 2016-05-13

```
country=US
ctrl_interface=DIR=/var/run/wpa_supplicant GROUP=netdev
update_config=1

network={
    ssid="your_real_wifi_ssid"
    scan_ssid=1
    psk="your_real_password"
    key_mgmt=WPA-PSK
}
```

{{<img caption="TEXT" src="/imgs/blog-imgs/sourdough-starter-monitor/ip-scan-results.png" >}}

### The Timelapse

#### Folder Structure

```text
    home/pi/
    ├── sourdough-monitor/
    │   ├── imgs/
    │   └── timelapse.sh
    └── run_sourdough_monitor.sh
```

#### Scripts

In `timelapse.sh`:
```bash
#!/bin/bash
# Calls 'raspistill' every 300s (ie. 5 mins) and writes the images
# to a new date/timestamped folder.

TOTAL_DELAY=300 # in seconds
CAM_DELAY=1 # need to have a nonzero delay for raspistill

# Must be 1.33 ratio
RES_W=1440
RES_H=1080

# Calculate the total delay time per cycle
SLEEP_DELAY=$(($TOTAL_DELAY-$CAM_DELAY))

FOLDER_NAME=imgs
mkdir -p $FOLDER_NAME # create image root folder if not exist

IDX=0 # image index

function cleanup() {
    echo "Exiting."
```

And in `run_sourdough_monitor.sh`:
```bash
#!/bin/bash
# Convenience script to run the monitor from home directory and launch
# in background

cd sourdough-monitor

# Start in background so ssh session can be closed
nohup ./timelapse.sh &> /dev/null &
```

## Putting it All Together

{{<img caption="Sometimes tape and random parts are the best way forward." src="/imgs/blog-imgs/sourdough-starter-monitor/IMG_20180527_173837.jpg" >}}
{{<img caption="The light was originally placed in front (as shown above), but the better method was to put the light behind the jars to maximize contrast and minimize glare." src="/imgs/blog-imgs/sourdough-starter-monitor/IMG_20180527_225557.jpg" >}}

To start:
```bash
$ ./run_sourdough_monitor.sh
```

To kill the process:
```bash
$ pkill timelapse
```

<div class="row captioned-img">
    <video class="img-responsive img-content" autoplay="autoplay" loop="loop" controls>
      <source src=/imgs/blog-imgs/sourdough-starter-monitor/timelapse.mp4 type="video/mp4" />
    </video>
    <p class="caption">The Timelapse</p>
</div>

## The Analysis

<!-- {{<loop-vid caption="The timelapse" src="/imgs/blog-imgs/sourdough-starter-monitor/timelapse.mp4">}} -->

{{<img caption="TEXT" src="/imgs/blog-imgs/sourdough-starter-monitor/Threshold Comparison_1.png" >}}

## The Results

### Timelapses

#### May 29, Left Jar
{{<loop-vid caption="May 29, Left Jar" src="/imgs/blog-imgs/sourdough-starter-monitor/2018-05-29 Levain Timelapse.mp4">}}

#### May 29, Right Jar
{{<loop-vid caption="May 29, Right Jar" src="/imgs/blog-imgs/sourdough-starter-monitor/2018-05-29 Levain Timelapse, Right.mp4">}}

#### May 31, First Feeding
{{<loop-vid caption="May 31, First Feeding" src="/imgs/blog-imgs/sourdough-starter-monitor/2018-05-31 Levain Timelapse.mp4">}}

#### May 31, Second Feeding
{{<loop-vid caption="May 31, Second Feeding" src="/imgs/blog-imgs/sourdough-starter-monitor/2018-05-31 Levain Timelapse 2.mp4">}}

#### June 10, Out of Fridge
{{<loop-vid caption="June 10, Out of Fridge" src="/imgs/blog-imgs/sourdough-starter-monitor/2018-06-10 Out of Fridge.mp4">}}

## Comparison

{{<img-span caption="TEXT" src="/imgs/blog-imgs/sourdough-starter-monitor/Levain Growth Over Time.png" >}}

{{<img-span caption="TEXT" src="/imgs/blog-imgs/sourdough-starter-monitor/Levain Growth Over Time (Regular Feeding).png" >}}

{{<img-span caption="Tight crumb (left), open crumb (right). This is why good fermentation is important!" src="/imgs/blog-imgs/sourdough-starter-monitor/Crumb comparison.png" >}}

