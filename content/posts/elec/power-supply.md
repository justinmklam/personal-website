+++
date = "2016-09-24T17:29:58-07:00"

draft = true

title = "Portable Power Supply"

tagline = "Providing power to the people. Or in this case, hobby projects."

summary = "Tired of using a spliced USB cable or combining batteries to achieve a desired voltage, an inexpensive boost-buck converter was paired with the input from a laptop power brick to supply variable voltage."

type = "elec"

image = "/imgs/power_supply/IMG_20160525_142454_300x300.jpg"

clickable = true
+++

__Objective:__ Build a cheap, portable, variable DC power supply.

__Motivation:__ It was finally time to get my hands on a variable power supply for my electronics projects. Previous projects mainly involved Arduino, which was able to supply 5V and 3.3V with ease. However, the need for a supply with higher voltage, current, and flexibility eventually arose, resulting in the birth of this ghetto (but functional) power supply.

__Limitations:__

+ Only DC voltages available
+ Max current is a function of input power and desired voltage (I=P/V)
+ Current limiting feature is non-existent, so must be careful to not let the genie out of circuits

<br>

{{< img src="/imgs/power_supply/IMG_20160525_142454.jpg" 
caption="Power supply in action, providing 12V to a reel of strip LEDs." >}}

{{< img src="/imgs/power_supply/IMG_20160525_143029.jpg"
caption="Internals of the power supply." >}}