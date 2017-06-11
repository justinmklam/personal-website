+++
date = "2017-06-10T15:56:53-07:00"
draft = false
image = "/imgs/blog-imgs/sous-vide-pla/banner.jpg"
title = "Annealing 3D Printed Plastics: Sous Vide Style"
tagline = "When hobbies combine and engineering takes over."
type = "blog"
layout = "single-blog"
tags = ["3d printing", "materials science"]
+++

> "Oh so you have a 3D printer? I read on the internet that you can make a gun with it."

No. Just no. Sure you can model it in your favourite CAD software and print one out, but at the end of the day **it's still a goddamn plastic gun.**

<!-- For a bullet to exit the chamber at any meaningful velocity to cause damage, an extremely high pressure needs to be created within the barrel (traditionally accomplished by a gunpowder explosion). So for a plastic gun, this means internal annihilation. But if you're going to use a metal barrel and other non-plastic parts with a printed enclosure, then that's the equivalent of covering a rock in snow for a snowball fight with your friends. And there's a special place after death for people who do that.-->

Rant aside, let's say we actually wanted to make a highly functional part (aside from a weapon) using a 3D printer. Maybe you need a replacement gear or a weight-bearing mounting bracket, and 3D printing would be the easiest way to fabricate the part. You carefully select your slicer settings to optimize shell thickness, infill density, and layer height based on your application.  You select a material that adequately suits your needs based on material strength or flexibility and environmental factors like UV exposure and heat resistance. You even take layer geometry into consideration to maximize strength in the loading direction.

{{<img caption="Optimal layer orientation with respect to direction of primary load." src="/imgs/blog-imgs/sous-vide-pla/layer-orientation.jpg" >}}

With all settings configured and high hopes for success, you load up the filament and hit "PRINT". Hours later and your part is complete and, giddy with excitement, you pop it off the printer bed and finally test the part.

{{<img caption="Fence bracket repaired (left), and broken after a heavy windstorm (right)." src="/imgs/blog-imgs/sous-vide-pla/broken fence.jpg" >}}

But it still fails. Tears ensue. Aspirations crumble. Is there any hope for the humanity of functional, 3D printed parts? Thankfully there's an entire industry dedicated to squeezing every ounce of performance out of material properties, so that should be an adequate starting point!

### A Primer in Heat Treatment

In metallurgy (the study of physical and chemical behaviour of metallic elements), annealing is a heat treatment process that alters the material's physical (and sometimes chemical) properties[^1]. For common metals such as copper, steel, silver, and brass, the process looks something like:

[^1]: [Annealing (metallurgy)](https://en.wikipedia.org/wiki/Annealing_(metallurgy)), Wikipedia.

1. Heat material until glowing 
2. Maintain at desired (recrystallization) temperature
3. Slowly let cool to room temperature

<!--In more scientific terms, these three stages of annealing are known as recovery, recrystallization, and grain growth. In recovery, the material is softened to relax its internal defects in the grain structure called _dislocations_, which normally cause internal stresses. In recrystallization, new strain-free grains grow in place of the dislocations. In grain growth, the microstructure coarsens-->

Typically with any material, internal defects are evident (notably on a microscopic scale) and create internal stresses which weaken its overall strength. When creating metal parts, the initial metal-forming processes create these defects and as a result, the metal will crack under stress along these stress-forming juncture lines called "grains". To minimize the effect of these grains, annealing can be done to soften the material, relax the grain structures causing the internal stresses, and allow new, strain-free grains to form as replacements. 

{{<img caption="Diagram showing the effect of heat treatment on the material's microstructure. (Source: Rigid Ink Blog)" src="/imgs/blog-imgs/sous-vide-pla/annealing_prints.jpg" >}}

With 3D printed parts, these internal defects occur on a more macroscopic scale[^2]. Plastic is heated, pushed through the extruder nozzle, and quickly cooled to form a layer of a printed part. Since plastic is poor conductor of heat, it cools unevenly and result in a mishmash of internal defects and grains. When an entire part is fabricated with this method, there's really no surprise that parts usually break fairly easily! Each printed layer forms a juncture line of non-ideal bonding, and within each layer yields internal stresses due to rapid and uneven cooling. 

[^2]: [How to Anneal Your 3D Prints for Strength](https://rigid.ink/blogs/news/how-to-anneal-your-3d-prints-for-strength), Rigid Ink.

### Annealing, Plastic, And You

3D printing shines in the rapid creation of designs with moderately complex geometries. From trinkets to tool holders and enclosures to gear trains, 3D printing has found its way into a variety of purposes. However, at the end of the day, they're only plastic parts having limited practicality in more demanding applications. 

From our newfound knowledge in maximizing material performance in metals, we know:

1. Internal stresses are bad
2. Internal stresses are created when a material is pushed, squeezed, and formed into a part
3. Internal stresses can be reduced by reheating, softening, and re-hardening the part

Fortunately, a similar heat treatment process can be applied to plastics to remove these nasty stresses and allow internal harmony to coalesce. I came across a research paper by Lih-Sheng Turng and Yottha Srithep, which discusses the relationship of crystallinity (ie. the degree of structural order in a solid) and mechanical properties of injection molded polylactide, commonly known as PLA[^3].

... Or, in plain English: they took a bunch of plastic sample pieces, performed some heat treatment on them, stuck them back in an oven to see if they still deform, and measured how much better the annealed samples hold up in the heat. Let's dig in and see what they found!

[^3]: [Annealing conditions for injection-molded poly(lactic acid).](http://www.4spepro.org/pdf/005392/005392.pdf), Plastics Research Online.

### Science Alert: The Nitty Gritty of Crystallinity

To go into a bit more detail, increasing a polymer's crystallinity is good because it can lead to an increase in stiffness, strength, heat deflection temperature, and chemical resistance. However, this is difficult to do with PLA because of its low crystallization rate and its required slow cooling rate.

{{<img caption="Clear samples are non-annealed, opaque are annealed. The first sample (from bottom) had the lowest degree of crystallinity and least heat resistance at 65°C. (Source: Turng and Srithep, 2014)" src="/imgs/blog-imgs/sous-vide-pla/pla-annealing-paper.jpg" >}}

Looking at the graph below, we see that the PLA samples had a maximum crystallinity of about 49%. Maintaining the oven/annealing temperature at 80°C led to the fastest rate of crystallization, whereas 65°C had the slowest rate. However, this shows that maximum crystallinity can be achieved even at lower temperatures, as long as the material is given enough time to sufficiently undergo recrystallization. 

{{<img caption="Degree of crystallinity versus annealing time. (Source: Turng and Srithep, 2014)" src="/imgs/blog-imgs/sous-vide-pla/crystallinity vs annealing time.JPG" >}}

So what's the takeaway? Unfortunately, this paper only tested the heat resistance of the annealed samples, as it would have been interesting to see them evaluate other mechanical properties such as tension/compression and getting a stress/strain curve out of it all. But this at least sheds some insight on performing heat treatment on PLA; if it improves heat resistance, then it should also improve other (potentially related) mechanical properties.

### Current Methods in the 3D Printing Community

From a cursory search, annealing PLA seems to be a common, known method in squeezing a bit of extra mechanical performance out of printed parts. YouTubers Thomas Sanlader[^4] and Joe Mike Terranella[^5] have shown both quantitative and qualitative results in strength improvements by annealing. 

Thomas' approach in testing oven-baked samples was nicely scientific, and warping was shown to be an issue since ovens aren't great at providing even, uniform heating. Joe's approach with boiling PLA was a good proof of concept, but it was only qualitative, his parts were floating in the water, and most importantly, no data was collected (savage). 

[^4]: [Bake your PLA and have it outperform everything else!](https://www.youtube.com/watch?v=CZX8eHC7fws), Thomas Sanladerer.
[^5]: [Annealing MakerGeeks Raptor PLA - The Boil Method](https://www.youtube.com/watch?v=WmTGU3r53VU), Joe Mike Terranella.

{{<img caption="Annealing various 3D printed plastics in an oven. (Source: Thomas Sanlader, YouTube)" src="/imgs/blog-imgs/sous-vide-pla/screencap-thomas-sanlader.JPG" >}}

{{<img caption="Boiling PLA for 10 minutes for extra strength. (Source: Joe Mike Terranella, YouTube)" src="/imgs/blog-imgs/sous-vide-pla/screencap-terranella.JPG" >}}

Using water as a heat source is advantageous because it provides fairly uniform heating, but temperature control is fussy to maintain a specific temperature. Ovens are convenient since it provides a (moderately) temperature controlled chamber, but heat transfer from the heating element to the part is less than ideal and still leads to uneven heating. 

If only there was a way to combine the temperature control of an oven and uniform, stable heating of a water bath...

### Annealing PLA with... Sous Vide?

Yes, that's right. Sous vide is the ultimate hero of this story.

A while back, I made a [sous vide controller](/projects/elec/sous-vide/) to get in on the cooking fad. A few months later and the novelty wore off, but I still had a modular, capable temperature controller ready for its next task (coffee roasting comes to mind, but I digress). In comes my 3D printer, and the combination of cooking and tinkering lead to the idea of performing heat treatment with a kitchen gadget.

{{<img caption="DIY sous vide controller hooked up to a kettle." src="/imgs/blog-imgs/sous-vide-pla/IMG_20170318_130307.jpg" >}}

Ladies and gentlemen, welcome to the meat and potatoes of this post. 

To recap, we've learned why annealing is desirable to reduce internal stresses (ie. increase crystallization), what previous research has identified, and what current heat treatment processes have already been tried. Although the presented information has helped in answering our preliminary questions, we still have unanswered ones that are left for us to uncover and test:

#### Objectives

1. Will annealing PLA in a temperature controlled water bath improve its mechanical properties?
1. What effect does layer height have on annealed parts?
1. Do we really need to cool the samples slowly, or can we get away with (quicker) cooling in room temperature?

#### Methods - Annealing Process

1. Print 9 rectangular prisms as the test samples
1. Remove 3 samples as the control set (ie. unmodified and directly off the printer)
1. Fill kettle with room temperature water
1. Submerge the remaining 6 samples in water bath
1. Set desired temperature of water bath
1. Maintain temperature for 30 mins
1. Remove 3 samples (1st sous vide set) and allow to air cool at room temperature
1. Turn off heat and allow the remaining 3 samples (2nd sous vide set) to slowly cool with the water bath

{{<img caption="Deprecated pennies were used to keep the samples submerged in the temperature controlled water bath." src="/imgs/blog-imgs/sous-vide-pla/IMG_20170318_183551.jpg" >}}

{{<img caption="Test samples lined up for carnage." src="/imgs/blog-imgs/sous-vide-pla/IMG_20170318_165409.jpg" >}}

Wait, hold the phone: this leads to even more questions! What annealing temperature is going to be maintained? How long are the samples going to be annealed for? Why are the samples so small?

All great questions, but unfortunately not all have great answers.

**Q: What annealing temperature are we going to maintain?**

PLA melts around 180-220°C, and its glass transition temperature is between 60-65°C[^6]. We're interested in the latter since that's the temperature where recrystallization occurs. However, lower quality PLA requires higher temperatures due to more impurities in the material. To be safe, we'll set the temperature to 70°C. According to the graph of crystallinity vs annealing time (a few page scrolls above), we'll hit the maximum 48-49% crystallinity at around 6 hours.

**Q: Wait, 6 hours of annealing time? Are we really going to wait that long?**

Ain't nobody got time for that! I'm an impatient guy, and waiting for my 3D prints to finish is painful enough. If we want to be robust in our test methods, sure we can wait 1/4 of an entire day to extract a bit more performance out of a plastic part. But I'm also a practical guy, so I want to see how little time I can get away with to achieve a meaningful increase in strength. My threshold for this is about 30 minutes; anything longer and I would question if it's worth it for everyday printing, so we'll go with that.

**Q: Sounds good. But why are the test samples so small? Other people seem to test with much larger parts.**

Since we're applying (what we'll assume to be) a point force, the sample doesn't actually need to be that long. In terms of cross-sectional area, wall thickness has a much larger impact on a part's strength than infill. Thus, these samples were designed to be hollow with a 2.0 mm wall thickness, which is actually a reasonable thickness for standard printed parts. Since those are the criteria that needs to be met, the sample just needs to be big enough to be able to test with (ie. long enough to span the gap). And going back to my impatience, 8 minutes is about the longest I want to wait for these samples since I'll be printing multiple of these. 

[^6]: [PLA](http://reprap.org/wiki/PLA), RepRap Wiki.

Now that that's out of the way, we can finally start testing and breaking things!

#### Methods - Quantifying Maximum Load

1. Place test jig on top of bathroom scale
1. Apply vertical point force on the sample with drill press handles
1. Record maximum load before sample catastrophically explodes

{{<img caption="Overview of test setup. Camera is used to capture the scale measurement at peak force." src="/imgs/blog-imgs/sous-vide-pla/IMG_20170319_164047.jpg" >}}

{{<vid caption="The conversion of potential to kinetic energy, recorded on an iPhone 6 at 240 fps." src="https://gfycat.com/ifr/MintyEvenBanteng">}}

### The Results

Stay tuned.

<!--To recap:

#### Hypotheses

1. Annealing PLA in a temperature controlled water bath will promote crystallinity (and thus lower internal stress) in comparison with using conventional ovens.
1. Samples printed at a 0.175 mm layer height will have higher internal stress than those at 0.2625 mm.
1. Samples cooled at room temperature in air will have higher internal stress than samples cooled with the water bath.-->