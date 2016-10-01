+++
clickable = true
date = "2016-09-25T12:36:28-07:00"
hidden = false
image = "/imgs/haikuza/Haikuza-twitter-screencap-v4-e1458001635541-300x300.png"
summary = "Spamming your phone's predictive keyboard is usually enough justification to avoid trying to computationally bang out the works of Shakespeare. Futile goals aside, an algorithm was developed to generate haikus using natural language processing and song lyrics."
tagline = "Contributing to society with an interactive, Twitter-based haiku generator."
title = "Project Haikuza"
type = "software"
draft = false
+++

<p><strong>Objective:</strong> Develop an algorithm to generate haikus using song lyrics.</p>

<p><strong>Motivation:</strong> Because computational linguistics are cool.</p>

<p><strong>Source</strong>: <a href="https://twitter.com/thehaikuza" target="_blank">twitter.com/thehaikuza</a></p>

<p><strong>Features:</strong></p>
<ul>
	<li>Scrapes <a href="http://www.vancouver.virginradio.ca/broadcasthistory.aspx" target="_blank">Virgin Radio's broadcast history</a> to find recently played songs</li>
	<li>Creates a song-based haiku queue in <a href="https://docs.google.com/spreadsheets/d/1HazfuywY_MrmQ49fxSpHOMA8QXBUYVhEDx1e4qhjbqU/edit?usp=sharing" target="_blank">Google Sheets</a></li>
	<li>Generates a haiku using the queue as a reference and posts it on Twitter</li>
	<li>Checks for new tweets every 5 minutes and generates a relevant haiku, if requested</li>
	<li>Finds all song lyrics from <a href="http://lyrics.wikia.com/Lyrics_Wiki" target="_blank">Lyrics Wikia</a></li>
	<li>Runs on a Raspberry Pi</li>
</ul>

<p>
<strong>Challenges:</strong></p>
<ul>
	<li>Formulaically counting syllables</li>
	<li>Developing a context-free language model</li>
	<li>Creating phrases that actually make sense</li>
</ul>

<p><strong>Framework:</strong> Python 2.7.9</p>

{{<img caption="Screencap of @thehaikuza's Twitter profile"
src="/imgs/haikuza/Haikuza-twitter-screencap-v3-e1458090798553.png">}}

{{<img caption="Raspberry Pi 1 Model B running @thehaikuza, 24/7!"
src="/imgs/haikuza/IMG_20150803_180047-1024x768.jpg">}}