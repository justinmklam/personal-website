+++
date = "2018-06-21T17:50:22-07:00"
draft = true
image = "/imgs/blog-imgs/sourdough-starter-monitor/Crumb comparison.png"
layout = "single-blog"
tagline = "Bread is love, bread is life; would it be wrong to call it my wife?"
tags = ["programming", "python", "image analysis"]
title = "Using Computer Vision to Monitor Fermentation of Wild Yeast"
type = "blog"

+++
Bread, the quintessence of life. People have survived off this staple for centuries using only flour, water, salt, and yeast. If you were to try consuming those ingredients individually, your body refuse it. However, by combining them together and letting time do its thing, you get fermentation of healthy bacteria that releases flavour, texture, and nutrients that were previously locked away.

# The Backstory
Blah blah blah

# The Development

## Setting It Up

### Headless Raspberry Pi Zero

Setting up a Raspberry Pi is very easy these days.

1. Download [Raspbian](https://www.raspberrypi.org/downloads/raspbian/)
2. Flash it to an SD card with something like [Etcher](https://etcher.io/)

The only hiccup I ran into was setting up without any monitor or ethernet attached, so getting it connected to WiFi and retrieving its IP address was non-trivial. Luckily, other people have run into the same problem over at the [Raspberry Pi forums]((https://www.raspberrypi.org/forums/viewtopic.php?t=191252).
The solution:

1. Create an empty file on the SD's boot partition called `ssh` to enable it.
2. Create another file named `wpa_supplicant.conf` with the following content:

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

Connect the camera module, boot it up, and with any luck you should be able to ssh into it from your own computer!

### Creating the Timelapse

Fortunately, the Pi comes loaded with `raspistill`, a command line tool to capture images (see [here](https://www.raspberrypi.org/documentation/usage/camera/raspicam/raspistill.md) for documentation). All we need to do is to write a simple shell script to execute this command every N seconds to create a timelapse.

**Note**: The easiest option is to use the built in [timelapse mode](https://www.raspberrypi.org/documentation/usage/camera/raspicam/timelapse.md). However, I put it in a script to automatically create a new datestamped folder every time a new instance is run.

#### Folder Structure

I set up two scripts, one to take the timelapses, and another to start the timelapse as a background process.

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

Nothing fancy here, so let's move along!

## Putting it All Together

Sure I could have 3D printed an enclosure, but where's the fun in that when readily available materials can be used to achieve the same result? Might not be as pretty, but when bread is on the line then nothing else matters. All we're here for is the data!

{{<img caption="Sometimes random parts and a bit of tape are the best way forward." src="/imgs/blog-imgs/sourdough-starter-monitor/IMG_20180527_173837.jpg" >}}

{{<img caption="The light was originally placed in front (as shown above), but a better method was to put the light behind the jars to maximize contrast and minimize glare." src="/imgs/blog-imgs/sourdough-starter-monitor/IMG_20180527_225557.jpg" >}}

To start the timelapse, ssh into the Pi and execute the following:
```bash
$ ./run_sourdough_monitor.sh
```

The next morning, you can ssh back in and kill the process with:
```bash
$ pkill timelapse
```

Now we have some data to analyze!

<div class="row captioned-img">
    <video class="img-responsive img-content" autoplay="autoplay" loop="loop" controls>
      <source src=/imgs/blog-imgs/sourdough-starter-monitor/timelapse.mp4 type="video/mp4" />
    </video>
    <p class="caption">Timelapse taken over ~10 hours at 5 minute intervals. Shown: Two sourdough starters with different feeding ratios.</p>
</div>

## The Analysis

The computer vision part of this project was quite straightforward, thanks to scikit-learn. All we have to do is to:

1. Apply a binary threshold to the image to get two distinct regions
2. Find the location of the boundary line

Fortunately, these are very easy to do with this library! The two main required components:

+ [skimage.filters](http://scikit-image.org/docs/dev/auto_examples/segmentation/plot_thresholding.html) - For applying thresholds
+ [skimage.measure](http://scikit-image.org/docs/dev/auto_examples/segmentation/plot_regionprops.html) - For measuring region properties

### Thresholding the Image

There are many threshold algorithms to choose from, and fortunately scikit-learn comes with a handy function to try them all at once.

```python
import matplotlib.pyplot as plt
from skimage.filters import try_all_threshold

img = io.imread('2018-05-31 Levain Timelapse/test.jpg', as_grey=True)
img = img[0:1000, 650:1100]   # crop image to zoom in to jar

fig, ax = try_all_threshold(img, figsize=(10, 8), verbose=False)
plt.show()
```

Running the above code yields the following image:

{{<img caption="The try_all_threshold() function is fast and convenient to see which will likely be the best for an image." src="/imgs/blog-imgs/sourdough-starter-monitor/Threshold Comparison_1.png" >}}

Discussing the different thresholding algorithms is beyond the scope of this post, but what we're looking for is one that is able to separate the boundary between the clear glass jar and the opaque sourdough starter. From the image above, it looks like isodata, otsu, and yen provide the sharpest thresholded boundary.

Given a hot tip from my coworker (thanks Andreas) that Otsu's method is a good one to pick, we can dig deeper into it. From the docs:

> Otsu’s method calculates an “optimal” threshold (marked by a red line in the histogram below) by maximizing the variance between two classes of pixels, which are separated by the threshold. Equivalently, this threshold minimizes the intra-class variance. - [SciKit Image Docs](http://scikit-image.org/docs/dev/auto_examples/segmentation/plot_thresholding.html)

The main takeaway with Otsu's method is that it works best with a bimodal distribution. For our image, this means the histogram should be represented by two distinct peaks. Since our cropped image looks to have two distinct regions, let's confirm that this method will be sufficient.

```python
plt.hist(img.ravel(), bins=256, range=(0.0, 1.0), fc='k', ec='k')
plt.title('Histogram of Original Image')
plt.show()
```

Plotting the histogram yields the following result:

{{<img caption="The image is a bimodal histogram, so Otsu's method should work well." src="/imgs/blog-imgs/sourdough-starter-monitor/histogram.png" >}}

Great, the histogram shows just what we need! (Except for the high concentration of saturated pixels, but let's just ignore that for now...)

Taking a closer look at the thresholded image:

```python
from skimage.filters import threshold_otsu

thresh = threshold_otsu(img, nbins=5)
binary_img = img < thresh

fig, axes = plt.subplots(ncols=2)
ax = axes.ravel()

ax[0].imshow(img, cmap=plt.cm.gray)
ax[0].set_title('Original image')

ax[1].imshow(binary_img, cmap=plt.cm.gray)
ax[1].set_title('Result')

plt.show()
```
{{<img caption="The result of Otsu's thresholding method." src="/imgs/blog-imgs/sourdough-starter-monitor/threshold-comparison.png" >}}

Those white blobs on the walls of the jar may still be detected as regions of interest, but applying a minimum thresholded area will help with false positives. Luckily, we have moderate control of the lighting and contrast of the object in question. If we're lucky we won't have to change much for the timelapses taken at different times of the day!

### Quantifying the Image

With our binary image, we can now use skimage.measure to easily get quantified properties of the regions. Full list of properties can be found [in the docs](http://scikit-image.org/docs/dev/api/skimage.measure.html#skimage.measure.regionprops).

```python
height = None

fig, ax = plt.subplots()
ax.imshow(binary_img, cmap=plt.cm.gray)

label_img = label(binary_img)
regions = regionprops(label_img)

for props in regions:
    y0, x0 = props.centroid

    minr, minc, maxr, maxc = props.bbox
    bx = (minc, maxc, maxc, minc, minc)
    by = (minr, minr, maxr, maxr, minr)

    area = (maxc-minc)*(maxr-minr)

    if area >= min_area:
        # Plot the bounding box
        ax.plot(bx, by, '-b', linewidth=2.5)
        # Plot the centroid
        ax.plot(x0, y0, 'ro')
        height = minr

plt.show()
```

The resultant image below shows how multiple areas are detected and classified. However, we can apply some RI(TM) (aka. *real* intelligence) to only pick the region of the sourdough starter. There are many ways to do this, but the simplest was to simply set a minimum area requirement. As long as it's high enough, it should ignore all the other regions.

{{<img caption="Minimum area is required since other areas will register as a detected region." src="/imgs/blog-imgs/sourdough-starter-monitor/min-area.png" >}}

Due to the camera perspective and curvature of the jar, the boundary between the two regions is not actually straight. This was solved by taking a much narrower cropped region, which you will see below in the animated timelapses.

{{<img caption="This may have been a bit easier with a square container..." src="/imgs/blog-imgs/sourdough-starter-monitor/first-thresh.png" >}}

Now that we have a working understanding of the components we need, let's get scripting and collect a bunch of data! You can check out the full analysis on [Github](https://github.com/justinmklam/sourdough-starter-monitor).

## The Results

The timelapses below show the sourdough starter from different dates. The boundary tracking algorithm is reasonably well at detecting the correct height, but there are occasional outliers that cause the errors. However, the overall trend of the growth is still captured.

### May 29, Left Jar
{{<loop-vid caption="The rise on the left jar had the cleanest growth trace." src="/imgs/blog-imgs/sourdough-starter-monitor/2018-05-29 Levain Timelapse.mp4">}}

### May 29, Right Jar
{{<loop-vid caption="A narrow crop area had to be used to prevent detection of uneven rise levels." src="/imgs/blog-imgs/sourdough-starter-monitor/2018-05-29 Levain Timelapse, Right.mp4">}}

### May 31, First Feeding
{{<loop-vid caption="Sunlight through the kitchen window created glare on the bottom left area on the jar, which affected the binary thresholding." src="/imgs/blog-imgs/sourdough-starter-monitor/2018-05-31 Levain Timelapse.mp4">}}

### May 31, Second Feeding
{{<loop-vid caption="Having the jar farther away reduced the thresholding accuracy, but the overall trace was still acceptable." src="/imgs/blog-imgs/sourdough-starter-monitor/2018-05-31 Levain Timelapse 2.mp4">}}

### June 10, Out of Fridge
{{<loop-vid caption="A larger jar was needed for this one! The thresholding algorithm was surprisingly still able ot catch the peak to some extent, despite minimal contrast." src="/imgs/blog-imgs/sourdough-starter-monitor/2018-06-10 Out of Fridge.mp4">}}

### June 23, First Feeding
{{<loop-vid caption="A larger jar was needed for this one! The thresholding algorithm was surprisingly still able ot catch the peak to some extent, despite minimal contrast." src="/imgs/blog-imgs/sourdough-starter-monitor/2018-06-23 First Feeding.mp4">}}

### June 23, Refeeding
{{<loop-vid caption="A larger jar was needed for this one! The thresholding algorithm was surprisingly still able ot catch the peak to some extent, despite minimal contrast." src="/imgs/blog-imgs/sourdough-starter-monitor/2018-06-23 Refeeding.mp4">}}

## The Discussion

The animations are cool to watch, but what can we interpret from it? Plotting all the growths (as shown below), we see that they seem more similar than different. The peaks hover around 60-80%, and the rate of growth coming up to the peak are similar. 

{{<img-span caption="All the timelapses plotted to compare normalized growth. Horizontal dotted line indicates 50% mark." src="/imgs/blog-imgs/sourdough-starter-monitor/all-growths_1.png" >}}

### Effect of Regular Feeding

Taking only a select number of days, there is a clearer trend to be seen! We started to regularly feed it, and the graph below shows how the growth magnitude and rate increase over feedings. 

On May 29th, we began to feed our sourdough starter after many months of sporadic feeding. With the June 10th growth (and visually correcting for the step at 6 hours), the rate of growth looks to be more exponential-like rather than more linear-like, as the other two feedings show.

{{<img-span caption="We can see that regularly feeding the sourdough starter greatly increases its rate and growth." src="/imgs/blog-imgs/sourdough-starter-monitor/Levain Growth Over Time (Regular Feeding).png" >}}

**Note**: The time delay of each subsequent feeding day may not mean anything, and may be purely coincidental that it looks like a pattern. Starting temperature plays a significant role in the fermentation cycle, and it was likely that the June 10 was fed right after being taken out of the fridge. 

What we should pay attention to is the change in growth and the growth rate, not the shift in the horizontal axis. However, if you have any other insight as to what may cause this shift, please leave a comment below!

### Bringing the Starter Back to Life

Previous to June 23, the starter was neglected for a week. After the first (overnight) feeding, it showed little signs of growth. However, feeding it again at lunch and tracking its progress shows that the growth springs back up to ~80%, which was around the previous maximum from before. 

{{<img-span caption="What doesn't kill you makes you stronger (or at least as strong as before)." src="/imgs/blog-imgs/sourdough-starter-monitor/refeeding_1.png" >}}

Thus, a bit of neglect seems to be okay since it appears to be somewhat resilient to starvation!

## The Conclusion

<!-- {{<img-span caption="Tight crumb (left), open crumb (right). This is why good fermentation is important!" src="/imgs/blog-imgs/sourdough-starter-monitor/Crumb comparison.png" >}}
 -->
