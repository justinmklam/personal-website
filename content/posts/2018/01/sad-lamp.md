+++
date = "2018-01-05T19:42:57-08:00"
draft = false
image = "/imgs/blog-imgs/sad-lamp/Verilux Spectral Response - Comparison.PNG"
layout = "single-blog"
tagline = "Shedding the light of truth on a $70 bulb."
tags = ["spectroscopy"]
title = "Measuring the Spectral Response of a Light Therapy Lamp"
type = "blog"

+++

<!-- _Disclaimer: Light therapy is one method of easing seasonal affective disorder (SAD); some people swear by it whereas others remain unaffected. This blog post does not intend to refute the effectiveness of light therapy, but rather to dig deeper into the technology behind these light therapy lamps to better educate fellow consumers._ -->

Ah, the winter blues of Vancouver, BC. While some days bring bluebird skies and [fresh pow](https://media1.tenor.com/images/25e5bfdf6e824bfa330964b5e0e48855/tenor.gif?itemid=5287297) for skiing, other days are downright gloomy. Spending this past Christmas in Singapore meant warm, sunny, and +25°C weather, which is quite atypical of how most Canadians spend their winters. However, coming back to the overcast, bone-chilling, gray, and wet Vancouver winter was a climate shock my body had yet to feel before. A week or so of jetlag-ridden sleep cycles and my circadian rhythm was back to normal, but I couldn't scratch the itch of yearning for sun and truly despising this city's gloomy winter weather.

Thanks to Amazon Prime's same/one day shipping, a solution to this problem was less than 24 hours away. Introducing my new light therapy lamp!

<!-- {{<img caption="Verilux's compact light therapy lamp and its advertised benefits." src="/imgs/blog-imgs/sad-lamp/lamp benefits.png" >}} -->

{{<img caption="Verilux HappyLight Compact Light Therapy Lamp with the UV filter/diffuser installed." src="/imgs/blog-imgs/sad-lamp/IMG_20180104_192702.jpg" >}}

{{<img caption="Ultraviolet difuser/filter removed from the lamp. Wait a minute, is that just a CFL bulb?" src="/imgs/blog-imgs/sad-lamp/IMG_20180103_193302.jpg" >}}

But wait just one moment; upon unboxing the lamp, I noticed something familiar. The light source behind the box looked strangely similar to a standard CFL bulb... Had I just been duped into spending $70 for a plain old light bulb in a fancy plastic enclosure?

{{<img caption="Left: $14.99 Verilux Full Spectrum Bulb. Right: $1.50 Standard CFL bulb." src="/imgs/blog-imgs/sad-lamp/bulb comparison.png" >}}

Fortunately for me, I work at [MistyWest](https://mistywest.com/) and we have a fancy spectrometer that will allow me to confirm/deny my suspicions. It's used to measure the spectral power density at each wavelength of light (or in layman terms,it measures the intensity of each specific colour of light). The two main questions I was curious to answer:

1. Are the spectral characteristics of this bulb any different than a regular CFL bulb?
2. Is the filter/diffuser actually made of a special UV-blocking material?

But before we get into the details of spectral characteristics, let's shed _a bit of light_ on the different lighting methods and how they came to be. (Stay with me; it's worth it.)

### Illumination Nation

#### Overview of Light Sources
Different sources of light can have significantly different spectral characteristics. The figure below shows how six different light sources vary greatly at each wavelength. 

{{<img caption="Typical spectral characteristics and corresponding colours of various lighting. [Source: Housecraft]" src="/imgs/blog-imgs/sad-lamp/spectral_responses2.png" >}}

+ **Daylight** 
    + Rounded peak around 450 nm
    + Broad spectrum light intensity
    + 5000 - 6500K
+ **Incandenscent** 
    + Increases from 400 nm to 700 - 800 nm
    + Burning of tungsten filament inside a vacuum bulb produces a very warm glow (in addition to a great amount of heat!)
    + 2400 K
+ **Fluorescent**
    + Distinct peaks around 420 nm, 490 nm, 550 nm, and 610 nm
    + Peaks are due to the fluorescence of excited phosphor within the glass tube
    + 2700 - 6500 K
    
{{<img caption="Electricity ionizes the mercury and argon gas, producing UV light which hits the phosphor coating and finally fluoresces white. [Source: Natural Blaze]" src="/imgs/blog-imgs/sad-lamp/image-cfl.png" >}}

+ **Halogen**
    + Rounded peak around 600 nm
    + Also burns a tungsten filament, but the gas is at a higher pressure for brighter illumination (basically a more advanced incandescent bulb)
    + 2800 - 3400K
+ **Cool White LED**
    + Sharp peak around 450 nm, rounded peak around 550 nm
    + Gallium nitride on a sapphire substrate produces blue (first peak), and a phosphor coating produces yellow light through fluorescence (second peak)
    + 3500 - 4100 K
+ **Warm White LED**
    + Shallow peak around 450nm, large peak around 550 nm
    + Combining different phosphors change the fluorescent characteristics of the emitted light
    + 2700 K 

<!-- {{<img caption=". [Source: Serendip Bryn Mawr]" src="/imgs/blog-imgs/sad-lamp/incandescentbulb.jpg" >}} -->

{{<img caption="When an electron flows from anode to cathode across the band gap, it falls into a lower energy level and releases energy in the form of a photon (light). [Source: Lumen Electronic Jewelry]" src="/imgs/blog-imgs/sad-lamp/LED-explanation0.jpg" >}}

#### A Walk Down Memory Lane

Now, slapping some dates to the evolution of lighting technologies (thanks [Wikipedia](https://en.wikipedia.org/wiki/Timeline_of_lighting_technology#20th_century)) gives us a pretty good understanding of how this all played out:

+ *1904* - Alexander Just and Franjo Hanaman invent the tungsten filament for incandescent lightbulbs.
+ *1926* - Edmund Germer patents the modern fluorescent lamp.
+ *1927* - Oleg Losev creates the first LED (light-emitting diode).
+ *1953* - Elmer Fridrich invents the halogen light bulb.
+ *1962* - Nick Holonyak Jr. develops the first practical visible-spectrum (red) light-emitting diode.
+ *1981* - Philips sells their first Compact Fluorescent Energy Saving Lamps, with integrated conventional ballast.
+ *1995* - Shuji Nakamura at Nichia labs invents the first practical blue and with additional phosphor, white LED, starting an LED boom.

Through this brief overview of light sources, we can see how the different illumination methods developed from sending current through a tiny strand of wire making it glow bright, to using fluorescence as an energy efficient way to produce light (and also at different colour temperatures).

#### So What?
The takeaway through this stroll through history lane is this: even before taking the spectral measurement of this bulb, we already know that the likelihood of this light therapy bulb being different is quite low. The History of Light(TM) paints a clear path of what's economically possible in creating a light source, so this mystical light therapy bulb is almost certainly just your everyday compact fluorescent bulb with a GU10 base.

{{<img caption="Let's mix and match different bases and shapes and label it as a proprietary bulb! The marketing team will love it. [Source: Tomic Arms]" src="/imgs/blog-imgs/sad-lamp/bulb types.jpg" >}}

But since we're already here, let's measure the data anyway! It's not everyday we get to learn about the physics we're surrounded by, especially when it involves expensive ~~toys~~ instruments.

### Let's Get To It: Measuring the Spectral Response

{{<img caption="Spectral responses with and without the UV diffuser/filter." src="/imgs/blog-imgs/sad-lamp/Verilux Comparison.png" >}}

{{<img caption="Comparison of total irradiance with and without the diffuser." src="/imgs/blog-imgs/sad-lamp/chart.png" >}}

### True or Alternative Fact: UV Blocking Filter

{{<img caption="Detailed look at the UV exposure on a logarithmic scale." src="/imgs/blog-imgs/sad-lamp/Verilux Comparison - UV.png" >}}

{{<img caption="Comparison of irradiance in the UV range, with and without the diffuser." src="/imgs/blog-imgs/sad-lamp/chart (1).png" >}}
