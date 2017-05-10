+++
clickable = false
date = "2017-04-04T09:26:50-08:00"
hidden = false
image = "/imgs/vr-gantry/vr-gantry-300x300.gif"
summary = "Current high-performance virtual reality headsets require cable connections to a host computer. For room-scale VR, users must always be mindful of this cable since it poses not only as a tripping hazard, but also a detraction from the otherwise immersive VR experience. This autonomous cable management system is one solution to sucky cables."
tagline = "Tired of cables breaking presence in virtual reality? We are too."
title = "Overhead Robotic Gantry for Tethered VR Headsets"
type = "mecha"

+++

__Objective:__ Create an autonomous gantry to follow the HTC Vive headset around, keeping its cable behind the user at all times.

__Motivation:__ An extravagant party prop for an evening at CES 2017, hosted by MistyWest.

__Features:__

+ CoreXY planar gantry design
+ System built with 8020 aluminum extrusions and laser cut acrylic components 
+ Stepper motor control through Teensy 3.2
+ HTC Vive pose tracking through C++
+ Patent pending

__Skills:__

+ Mechanical design with rapid prototyping methods
+ C++ software development
+ Arduino-based firmware development

__Sources:__

+ [MistyWest Github](https://github.com/MistyWestAdmin)
+ Medium blog post titled [_Tired of cables in VR? We are too._](https://medium.com/@mistywest/tired-of-cables-in-virtual-reality-we-are-too-efeab5606bf0)

{{< vid caption="Demo video of the gantry in action." src="https://www.youtube.com/embed/zULBxDJVaHs" >}}

{{<img caption="The gantry being used at a penthouse party hosted by MistyWest during CES 2017. (Photo by Denis Godin)"
src="/imgs/vr-gantry/DSC1764.jpg" >}}

{{<img caption="People showing interest in the high-tech marriage between robotics and virtual reality. (Photo by Denis Godin)"
src="/imgs/vr-gantry/DSC1873.jpg" >}}

## The Development

{{<img caption="The gantry frame designed in SolidWorks 2017."
src="/imgs/vr-gantry/CAD.png" >}}

{{<img caption="Initial testing of the tracking using relative position commands, almost as if it has a mind of its own."
src="/imgs/vr-gantry/giphy_0.gif" >}}

{{<img caption="Revised tracking using absolute position commands for significantly improved precision."
src="/imgs/vr-gantry/giphy_1.gif" >}}

{{<img caption="First user test with the gantry attached to the lab ceiling (rotation tracking not yet implemented)."
src="/imgs/vr-gantry/giphy_2.gif" >}}

{{<img caption="After many hardware, software, and firmware tweaks, the gantry finally became usable."
src="/imgs/vr-gantry/giphy_3.gif" >}}

<!--{{<img caption="Achievement unlocked: Freedom of movement with wired VR."
src="/imgs/vr-gantry/vr-gantry.gif" >}}-->

{{<img caption="Construction of the free standing frame in preparation for bringing the rig to CES."
src="/imgs/vr-gantry/IMG_20161212_141058.jpg" >}}

{{<img caption="Testing the free standing setup to gain confidence in its sturdiness."
src="/imgs/vr-gantry/IMG_20161216_161302.jpg" >}}

{{<img caption="Yes, it is in fact portable!"
src="/imgs/vr-gantry/IMG_20161222_114418.jpg" >}}