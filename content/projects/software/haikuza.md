+++
clickable = true
date = "2015-07-19T12:36:28-07:00"
hidden = false
image = "/imgs/haikuza/Haikuza-twitter-screencap-v4-e1458001635541-300x300.png"
summary = "Spamming your phone's predictive keyboard is usually enough justification to avoid trying to computationally bang out the works of Shakespeare. Futile goals aside, an algorithm was developed to generate haikus using natural language processing and song lyrics."
tagline = "Contributing to society with an interactive, Twitter-based haiku generator."
title = "Project Haikuza"
type = "software"
draft = false
+++

__Objective:__ Develop an algorithm to generate haikus using song lyrics.</p>

__Motivation:__ Because computational linguistics are cool.</p>

__Project:__ [twitter.com/thehaikuza](https://twitter.com/thehaikuza)

__Features:__

+ Scrapes [Virgin Radio's broadcast history](http://www.vancouver.virginradio.ca/broadcasthistory.aspx) to find recently played songs
+ Creates a song-based haiku queue in [Google Sheets](https://docs.google.com/spreadsheets/d/1HazfuywY_MrmQ49fxSpHOMA8QXBUYVhEDx1e4qhjbqU/edit?usp=sharing)
+ Generates a haiku using the queue as a reference and posts it on Twitter
+ Checks for new tweets every 5 minutes and generates a relevant haiku, if requested
+ Finds all song lyrics from [Lyrics Wikia](http://lyrics.wikia.com/Lyrics_Wiki)
+ Runs on a Raspberry Pi

__Challenges:__

+ Formulaically counting syllables
+ Developing a context-free language model
+ Creating phrases that actually make sense

__Framework:__ Python 2.7.9

__Source:__ [Github](https://github.com/justinmklam/project-haikuza)

{{<img caption="Screencap of @thehaikuza's Twitter profile"
src="/imgs/haikuza/Haikuza-twitter-screencap-v3-e1458090798553.png">}}

{{<img caption="Raspberry Pi 1 Model B running @thehaikuza, 24/7!"
src="/imgs/haikuza/IMG_20150803_180047-1024x768.jpg">}}