+++
clickable = true
date    = "2017-04-04T09:26:50-08:00"
hidden  = false
image   = "/imgs/vr-gantry/vr-gantry-300x300.gif"
summary = "Current high-performance virtual reality headsets require cable connections to a host computer. For room-scale VR, users must always be mindful of this cable since it poses not only as a tripping hazard, but also a detraction from the otherwise immersive VR experience. This autonomous cable management system is one solution to sucky cables."
tagline = "Tired of cables breaking presence in virtual reality? We are too."
title   = "Overhead Robotic Gantry for Tethered VR Headsets"
type    = "mecha"
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
+ CES Founders and Friends 2017 Photo Gallery by [Natalia Leva](https://natalialeva.shootproof.com/gallery/3918977/home)

{{<vid caption="Demo video of the gantry in action." src="https://www.youtube.com/embed/zULBxDJVaHs" >}}

{{<img caption="The gantry being used at a penthouse party hosted by MistyWest during CES 2017. (Photo by Natalia Leva)"
src="/imgs/vr-gantry/DSC1764.jpg" >}}

## The Development Story

We wanted a solution to increase and maintain presence in virtual reality; having to worry about tripping over the cable takes away from it. What we needed was a way to mimic a cable sherpa, following our every movement to prevent tension in the cable and entanglement around our legs. Whether we were moving forward, backward, left, right, or turning around, we wanted a way to roam freely as if virtual reality was already wireless.

### Stage 1: Design and Testing 

We wanted to make this as quickly as possible, so I designed the rig using off-the-shelf parts and laser cut acrylic parts.

<div class="embed-responsive embed-responsive-16by9"><iframe src="https://sketchfab.com/models/3be6275ae3c048098c2c777d7817ff26/embed?autostart=0&amp;preload=1" frameborder="0" allowvr allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" onmousewheel=""></iframe>
</div>
<p class="caption">The gantry frame designed in SolidWorks 2017.</p>

Preliminary tests were less than stellar. I initially used relative position commands, but as the clip below shows, but it wasn't responsive enough for practical use.

{{<img caption="Initial testing of the tracking using relative position commands, almost as if it has a mind of its own."
src="/imgs/vr-gantry/giphy_0.gif" >}}

Changing the motor control to use absolute coordinates instead of relative showed promising results.

{{<img caption="Revised tracking using absolute position commands for significantly improved precision."
src="/imgs/vr-gantry/giphy_1.gif" >}}

An overview of the software algorithm to parse the user's current position and command the stepper motors is shown in the flowchart below.

{{<img caption="Flowchart of the software algorithm."
src="/imgs/vr-gantry/SoftwareFlowchart.png" >}}

### Stage 2: User Testing

The results were so promising, in fact, that we decided to strap it to the ceiling and do some user testing. The results were... Loud due to the rattling and vibrations from the stepper motors. System responsiveness was slow, so more work needed to be done.

{{<img caption="First user test with the gantry attached to the lab ceiling (rotation tracking not yet implemented)."
src="/imgs/vr-gantry/giphy_2.gif" >}}

Many revisions later, and the rig was finally working as expected!

{{<img caption="After many hardware, software, and firmware tweaks, the gantry finally became usable."
src="/imgs/vr-gantry/giphy_3.gif" >}}

<!--{{<img caption="Achievement unlocked: Freedom of movement with wired VR."
src="/imgs/vr-gantry/vr-gantry.gif" >}}-->

### Stage 3: Making it "Portable"

Since this was an internal project with [MistyWest](https://mistywest.com/), the value was in showing this prototype around. The social media content was one thing, but physically bringing it around was thought to have additional "wow" factors. Since CES 2017 was coming up and MistyWest would be hosting a penthouse party during one of the evenings, it was time to make this thing free standing. 

Continuing the theme with 8020 extrusions, the external frame was assembled and tested.

{{<img caption="Construction of the free standing frame in preparation for bringing the rig to CES."
src="/imgs/vr-gantry/IMG_20161212_141058.jpg" >}}

{{<img caption="Testing the free standing setup to gain confidence in its sturdiness."
src="/imgs/vr-gantry/IMG_20161216_161302.jpg" >}}

{{<img caption="Yes, it is in fact portable!"
src="/imgs/vr-gantry/IMG_20161222_114418.jpg" >}}

### Stage 4: Mission Complete

On January 6, 2017, the rig was set up in Las Vegas and (after some headache and remote debugging) the rig came alive at the [Founders and Friends 2017](https://mistywest.com/founders-friends-2017/). It was a huge hit amongst the tech enthusiasts and ran beautifully through the night.

{{<img caption="People showing interest in the high-tech marriage between robotics and virtual reality. (Photo by Natalia Leva)"
src="/imgs/vr-gantry/DSC1873.jpg" >}}

{{<img caption="Founders and Friends 2017. (Photo by Natalia Leva)"
src="/imgs/vr-gantry/DSC1658.jpg" >}}

The rig is now retired and sleeps soundly in its storage container. On to the next project!