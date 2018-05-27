+++
date = "2018-05-26T17:50:22-07:00"
draft = true
image = "http://placehold.it/900x300"
layout = "single-blog"
tagline = ""
tags = [""]
title = "OpenCV Monitor for Sourdough Starter"
type = "blog"

+++

# Setting Up Headless Raspberry Pi

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

{{<img caption="TEXT" src="/imgs/blog-imgs/levain-monitor/ip-scan-results.png" >}}