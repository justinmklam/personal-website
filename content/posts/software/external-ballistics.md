+++
clickable = true
date = "2016-09-25T12:36:19-07:00"
hidden = false
image = "/imgs/external_ballistics/Ballistics-Simulation-300x300.jpg"
summary = "Long range trajectories are heavily susceptible to external factors including (but not limited to) drag, gravity, air density, altitude, rotation of the bullet, and rotation of the Earth. One solution is to connect a computer to a manual targeting system and estimate the corrected target location by accounting for these external factors. A basic program was developed to simulate and calculate the required correction."
tagline = "Predicting projectile trajectories of shots, shots, shots, shots, shots, shots."
title = "External Ballistics Simulation"
type = "software"

+++

__Background:__ including (but not limited to) drag, gravity, air density, altitude, rotation of the bullet, and rotation of the Earth.

One solution is to connect a computer to a manual targeting system (ie. a scope) and estimate the corrected target location by accounting for these external factors.  The user may then line the manual targeting system up with the corrected target location, hoping to the high heavens that the target will be hit upon releasing the projectile.</p>

__Objective:__ Determine the required release angle given the muzzle velocity and target distance, accounting for external factors.</p>

__Limitations:__

+ Only the corrected vertical distance is calculated
+ Values have not yet been validated for accuracy
+ Purely mathematical simulations lack the accuracy provided by simulations backed by empirical data

__Framework:__ Python(x,y) 2.7.9.0

{{<img caption="Visualization of release angles between 0 and 90° given the same muzzle velocity." 
src="/imgs/external_ballistics/Ballistics-Simulation_0-deg-Scope-Angle_all_missed.png" >}}

{{<img caption="Flowchart of the algorithm to determine the required release angle." 
src="/imgs/external_ballistics/Ballistics-simulation-flowchart.png" >}}

{{<img caption="Visualization of the algorithm on the release angle increment. The magenta trajectory is 5° higher than the red trajectory; the green is 2.5° higher than the magenta, and so on."
src="/imgs/external_ballistics/Ballistics-Simulation_0-deg-Scope-Angle_all.png" >}}

{{<img caption="Predicted trajectory on flat ground."
src="/imgs/external_ballistics/Ballistics-Simulation_0-deg-Scope-Angle-exaggerated.png" >}}

{{<img caption="Predicted trajectory when target is uphill from user."
src="/imgs/external_ballistics/Ballistics-Simulation_18-deg-Scope-Angle.png" >}}

{{<img caption="Predicted trajectory when target is downhill from user."
src="/imgs/external_ballistics/Ballistics-Simulation_-9-deg-Scope-Angle.png" >}}