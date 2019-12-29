+++
image =     "/imgs/blog-imgs/diy-wedding-ring/J_H-323.jpg"
type =      "blog"
draft =     true
layout =    "single-blog"
tags =      ["3d-printing", "design"]
tagline =   "Sentimental sintered metal. (Actually casted, but this is more catchy.)"
title = "DIY 3D Printed Wedding Ring"
date = "2019-10-13T11:50:22-07:00"
+++

<p class="text-center" style="font-style:oblique">
Professional photos from <a href="http://justine-russo.com/" target="_blank">Justine Russo Photography.</a>
</p>

For readers of my blog, you'll notice that I haven't had any new content in the past year. For good reason though, as I got married in June! Aside from planning the proposal and wedding, I also had the lofty goal of designing and making my wife's engagement ring.

With this post, I'd like to share my quest in designing and 3D printing my wife's engagement ring, along with some \**minor*\* mistakes I made.

{{<loop-vid caption="Timelapse of the ring design in Fusion 360. (Yes I know, I should have just used a revolve feature, but I started out designing prongs and quickly abandoned that concept.)" src="/imgs/blog-imgs/diy-wedding-ring/fusion 360 screencast_trimmed.mp4">}}

# The Backstory

It all started with the diamond. My grandpa used to own a jewelry store, so my grandma naturally had a lot of jewelry. However, she doesn't wear much anymore, so a few years ago she took the five diamonds out of one of her bracelets and gave it to each of her grandchildren. My older sister and cousin made theirs into a pendant, but I just put mine in a safety deposit box. Eventually, I realized I could use the diamond for an engagement ring (+1 for sentimental value).

However, I didn't know many local shops where you can give them a stone to create a ring for it (mind you, this was an assumption and I didn't bother to validate it). Having experience with mechanical design and rapid manufacturing methods, I figured it was well within my capabilities to propose with a truly special, sentimental engagement ring. Turns out I was only partially right about this, but we'll get to that later...

The hardest part of this was keeping it a secret from Heather. We were already living together, so I had to do all the design work while "working late at the office" because of "tight deadlines". It worked out in the end, and I didn't have to pull too many extra hours to get it done!

# The Development

## Research

*~ September to October 2018 ~*

Fortunately, Heather and I had already talked about getting married, so bringing up the engagement ring was fairly easy. However, she didn't know when or how I would propose, so there would still be that as a surprise. She showed me a few rings and styles that she liked, so I collected those (secretly) and started to think about my own design.

{{<img caption="Design research and inspirations. Bottom right pictures were the closest to what I had in mind." src="/imgs/blog-imgs/diy-wedding-ring/inspiration.png">}}

Simple, quiet, yet elegant. These were the words that percolated my mind as I looked at dozens of engagement rings, and I eventually settled on a few key elements:

- A thin/light look
- Bezel set diamond
- Textured band
- Yellow gold

It was quite important to make sure the ring looked thin and light (without looking flimsy or cheap), since Heather's finger is very small. Like size 3.5, ie. 14.5 mm diameter small. With this, I knew I'd have to 3D print at least one prototype, because it's difficult to get a feel of physical proportions when looking at a CAD model on your computer screen.

## Specifications

Once I honed down on the desired design, I started my research on how to secure the stone. This was the most critical part of the design, as a diamond coming loose and falling out would not be good.

Turns out setting a stone in a ring is fairly straightforward, as it just involves bending metal over the lip of the stone. With a typical prong-style setting, you would bend the tip of each prong over the stone to secure it. With a bezel-style setting, you bend the entire lip over the stone. Since the stone is held by the entire circumference, the wall doesn't need to be as thick as with the prongs.

{{<loop-vid caption="How bezel set diamonds are typically set." link="https://www.youtube.com/watch?v=bqrf_XP2ZzI" link-text="Swarovski" src="/imgs/blog-imgs/diy-wedding-ring/bezel set.mp4">}}

However, as great as qualitative instructions are, what I needed were actual dimensions on wall thickness, height, bend distance, etc. After much Googling, I fortunately found an article with the information I needed!

{{<img caption="Design guidelines for bezel set features." src="/imgs/blog-imgs/diy-wedding-ring/144654.jpg" link="https://www.gia.edu/bench-tip-modified-tool-to-bezel-set-round-faceted-stones" link-text="GIA">}}

## First Prototype
*~ October 11 to 17, 2018 ~*

Luckily, one of my coworkers, [Phil Tsao](http://www.philiptsao.com), owns a plethora of rapid prototyping machines as part of his [Ember Prototypes](https://www.emberprototypes.com) side business. One of his fancy toys is the [Form 2 SLA Printer](https://formlabs.com/3d-printers/form-2/), which is well suited for printing intricate plastic parts with fine details. I sent him my first design, and I was able to have it in my hands the next day.

{{<img caption="Fresh off the Form 2 SLA printer (supports yet to be removed), with the diamond placed inside." src="/imgs/blog-imgs/diy-wedding-ring/IMG_20181018_123234.jpg" >}}

Good thing for inexpensive prototypes, because I wasn't happy with how it looked. It was too blocky and square, so I took a closer look at other rings to see what made them look better. After all, they say good design is invisible (to the untrained eye, and my eye for ring design is pretty inexperienced). One main aspect is that almost all surfaces on rings (and other jewelry, for that matter) are curved, allowing light to reflect off the surface in a more aesthetically pleasing way.

{{<img caption="You can see that the shape is quite blocky." src="/imgs/blog-imgs/diy-wedding-ring/IMG_20181018_123554.jpg" >}}

Given these findings, my list of change orders were as follows:

- Increase height of stone holder to make it "stand out" more
- Increase visibility of leaf pattern on band
- Increase height of ridge on band for a more pronounced look
- Round both inner and outer surfaces of band for comfort and aesthetic improvements

## Design Refinement
*~ October 22, 2018 ~*

Iterations are a key part of design (for both hardware and software). Seeing a physical prototype of the ring was extremely useful in determining what aspects needed changing. I was much happier with the ring after the aforemention revisions.

{{<img caption="Original design on left, revised design on right." src="/imgs/blog-imgs/diy-wedding-ring/IMG-20181028-WA0005.jpg" >}}

## Final Procurement
*~ October 28, 2018 ~*

If my timeline was more permitting, I would have printed this second version in an inexpensive metal like plated brass or silver. This would ensure the end result of the ring is exactly how I expect it to be, rather than have the risk of being surprised on the final order. However, given my expedited timeline, I opted to take the risk and just go for ordering the ring in 14K gold. If I ended up unhappy with it, paying another ~$200 would be acceptable (in my books) since the flipside of the risk was potentially proposing a few weeks earlier (and thus giving more time for the wedding planning!).

{{<vid caption="A quick tour of the Shapeways cast metal jewelry printing process." src="https://www.youtube.com/embed/Eq-BIw1_jX0" >}}

I hadn't used [Shapeways](https://www.shapeways.com) previously, but their offerings and capabilities looked promising. Aside from printing plastics and metals, [jewelry](https://www.shapeways.com/getting-started/jewelry) also seemed to be a common offering.

> Gold models are 3D printed using a complex five-step process. First, the model is printed in wax using a specialized high-resolution 3D printer. It is then put in a container where liquid plaster is poured in around it. When the plaster sets, the wax is melted out in a furnace, and the remaining plaster becomes the mold.
>
> Molten Gold is poured into this mold and set to harden. The plaster is broken away, revealing your new product. The product is then carefully cleaned and hand-polished to give it the trademark Gold luster. Please be aware that polishing can wear down or fill in very fine details and edges. Polishing also removes a bit of material from your product in order to smooth it out, so the exact volume may be up to 10% smaller than that of your digital model.
>
> \- [Shapeways: Gold Material Info](https://www.shapeways.com/materials/gold)

With that, I went ahead and placed the order. And so, the waiting game began (and planning the actual proposal)...

{{<img caption="Order placed (with express shipping, of course)." src="/imgs/blog-imgs/diy-wedding-ring/shapeways-order.jpeg" >}}

## Setting the Diamond

*~ November 6, 2018 ~*

I needed to figure out how to actually nicely bend the bevel over the stone. After scouring YouTube and Google for instructions, I came to the conclusion that it is actually quite a simple process:

1. Find a tool to form the edge over the stone
2. Bend the edge over the stone with the given tool'
3. Repeat for the circumference of the bezel

There are different tools available to do the bending. In the video below, a hammer-like tool is used to compress the edge on to the stone. In other videos, a file-like tool is pushed toward the center to bend the edge.

{{<vid caption="Full instructional video on bezel setting stones." src="https://www.youtube.com/embed/-5Ix57Cetek" >}}

{{<loop-vid caption="Snippet to show bending of the bezel edges to secure the stone in place." link="https://www.youtube.com/watch?v=0z6EOdgr6GQ" link-text="92nd Street Y" src="/imgs/blog-imgs/diy-wedding-ring/bezel set instructions.mp4">}}

Due to the tight tolerances of the bevel and (expected) imperfections of the casting process, I had to use a rotary tool with the smallest grind attachment to carve out the tiny bumps so the diamond would fit inside. Having a very good microscope was integral in this slow, methodical process.

{{<img caption="The finished product!" src="/imgs/blog-imgs/diy-wedding-ring/IMG_20181106_183320.jpg" >}}

Once the stone sat snuggly inside, I settled on using the shaft of a large screwdriver as the tool to bend the lip over the stone. This ended up working quite well, and a few minutes later, the ring was complete!

# The Outcome

## The Proposal

*~ November 18, 2018 ~*

{{<img caption="Locked and loaded." src="/imgs/blog-imgs/diy-wedding-ring/IMG_20181118_104503.jpg" >}}

{{<img caption="Patiently waiting at the same street corner we met on." src="/imgs/blog-imgs/diy-wedding-ring/DSC_0180.JPG" >}}

{{<img caption="She said yes!" src="/imgs/blog-imgs/diy-wedding-ring/heather 2.jpg" >}}

## ... The Mistake

*~ November 21, 2018 ~*

{{<img caption="The flat edge under the stone reduces the actual inner diameter..." src="/imgs/blog-imgs/diy-wedding-ring/ring-side-view.png" >}}

{{<img caption="The aftermath of the resizing. Fortunately it's not (very) visible while it's worn." src="/imgs/blog-imgs/diy-wedding-ring/aftermath.jpg" >}}

## The Wedding

*~ June 2019 ~*

{{<img caption="DIY engagement ring sandwiched between our not-DIY wedding rings." src="/imgs/blog-imgs/diy-wedding-ring/J_H-10.jpg" link="http://justine-russo.com/http://justine-russo.com/" link-text="Justine Russo Photography">}}

{{<img caption="Ceremony at the UBC Farm." src="/imgs/blog-imgs/diy-wedding-ring/J_H-144.jpg" link="http://justine-russo.com/http://justine-russo.com/" link-text="Justine Russo Photography">}}

{{<img caption="Cozy reception within the Poplar Grove." src="/imgs/blog-imgs/diy-wedding-ring/J&H-1124_websize.jpg" link="http://justine-russo.com/http://justine-russo.com/" link-text="Justine Russo Photography">}}

{{<img caption="Trying to cut the cake without toppling it over..." src="/imgs/blog-imgs/diy-wedding-ring/J&H-1184_websize.jpg" link="http://justine-russo.com/http://justine-russo.com/" link-text="Justine Russo Photography">}}

{{<img caption="Ending the night with the first dance." src="/imgs/blog-imgs/diy-wedding-ring/J&H-37_websize.jpg" link="http://justine-russo.com/http://justine-russo.com/" link-text="Justine Russo Photography">}}

## Final Thoughts

Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
