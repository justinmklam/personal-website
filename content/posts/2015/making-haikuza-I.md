+++
date = "2015-07-12T23:49:52-07:00"
draft = false
image = "/imgs/blog-imgs/making-haikuza/8Y0EDX4VP9.jpg"
layout = "single-blog"
tagline = "The development of a laughable haiku generator in Python."
tags = ["programming", "python"]
title = "The Making of Project Haikuza: Part 1"
type = "blog"

+++

_The format of this series is an outline of my thought process during the development of [@thehaikuza](/projects/software/haikuza/)._

> Haikus are simple

> Even children can write them

> maybe programs too?

Nothing is cooler than algorithmic poetry. Except for maybe Carl Sagan. I heard he was a pretty cool guy.

I was listening to the radio while driving home one Sunday evening, and an ad came up for a university that was submitting computer-generated poetry to a literature competition. Ive recently been fascinated by the many intricacies of the English language, so the thought of somehow teaching a computer how to construct proper phrases seemed like an elusive task. But hey, if Google is also working on natural language processing, then how hard can it be right?

The idea of computer generated text is often a humourous one. Spamming your smartphones predictive keyboard is usually enough justification to avoid trying to computationally bang out the works of Shakespeare. As laughable as the monkeys at a typewriter idea is, maybe weve become smart enough to at least get close to this literary pipe dream

### 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prequel: The Prudence of Pivoting

Needless to say, it can take a few tries to end up at a decent idea, and @thehaikuza was no exception. After hearing about the poetry contest, I wanted to develop something related to computational linguistics, but I was partial to run-of-the-mill poetry. High school English classes had given me a negative bias for this type of literary art, so naturally I was in search for a different end product.

Rap songs were the first to come to mind. After all, songs are simply poems accompanied by musical harmonies and melodies, so I wasnt too far off from the realm of poetic computations. However, I eventually realized that writing rap songs from scratch (not to mention by an algorithm) would have mountains of difficulty, especially since my knowledge of natural language processing was currently at ground zero.  I decided to scale back and start off small with the most simple form of poetry known to (probably) every North American student: the haiku.

Haikus are great because they are short in length and only have one simple rule: dont break the 5/7/5 syllable count per line. One of my coworkers suggested using Twitter as my platform for haiku generation, which would prove to be much easier than opening another can of worms of trying to develop my own web app.  Since theres already a Twitter API library for Python, and with each average haiku being under the threshold of 140 characters, my decision was made before I even had to think about it.

With the advent of using Twitter, I had a few more options I could play with. My first idea was to make haikus based on the trending topics on Twitter. This would give my Twitter-bot the dynamic quality thats inherent in the fast-paced nature of the internet, rather than just creating stale haikus about nature.  It could retrieve the trending topics, gather all the relevant tweets, and then use the collected phrases to formulate a relevant haiku.  In theory, this seemed like a great idea; in practice, not so much! After some prototyping, I quickly learned that the broken English, frequent spelling mistakes, and chaotic nature of < 140 character messages wouldnt serve as an adequate corpus for phrase generation.

Okay, well forget about that idea. But I still wanted a venue to stay relevant on the internet. I figured songs can also be relevant, especially if I would be grabbing ones that are currently playing on the radio. Adding an interactive element to @thehaikuza by making it able to respond to song requests would just be icing on the cake. Thus, @thehaikuza was born!

Or so I thought. Turned out it was still an embryo.

### 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Makin Bacon Haikus V0.1

The first research topic on my ever-growing list was to figure out what makes a sensible sentence. In elementary school, were taught that the most basic phrase consists of a subject and verb. In the sentence below, for example, the boy is the subject and is sweating is the action.

The boy is sweating.
Okay, this evidently isnt new knowledge to anyone. But what if we break down the phrase into types of words?  Referencing a universal part of speech (POS) tagging system, we get:

> [The, determinant] [boy, noun] [is, verb] [sweating, verb]


Interesting. Maybe I can create a Mad Lib-based language model that can learn the sentence structures of existing haikus, then use an external wordset to substitute the corresponding words. For poetry, and notably haikus, grammar isnt as important as a passive aggressive letter to your not-so-favourite mobile carrier, so I might be able to get away with this rudimentary language model.  (Spoiler alert: I couldnt.)

#### 2.1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Haiku Training

The plan was to create a machine-learning script (of sorts) that did the following:

Import a collection of human-written haikus
Extract the POS tags for each line
Construct a database of 5 and 7 syllable POS phrases
The implementation looked something like this:

```
import nltk

class LearnHaiku(object):
    def __init__(self, fname):
        self.haikus = self.parse(fname)
        self.pos_five, self.pos_seven, self.log = self.analyze()

    @staticmethod
    def parse(fname):
        haikus = []
        with open(fname) as inputfile:
            for line in inputfile:
                haikus.append(line)

        return haikus

    def analyze(self):
        line5s = []
        line7s = []
        errors = []

        is_line7s = 1
        numrows = len(self.haikus)

        for i in range(numrows):
            """Only parse if not a blank line"""
            if self.haikus[i] != '\n':
                try:
                    tags = nltk.pos_tag(self.haikus[i].split(' '), tagset='universal')
                    if i == is_line7s:
                        line7s.append([x[1] for x in tags])
                        is_line7s += 4
                    else:
                        line5s.append([x[1] for x in tags])
                except UnicodeDecodeError:
                    errors.append(i+1)

        log_str = "Couldn't parse line(s) %s." %(', '.join(str(x) for x in errors))

        return line5s, line7s, log_str

if __name__ == '__main__':
    hk = LearnHaiku("[REF] Haiku Training Examples V0.1.txt")
    print hk.pos_five
    print hk.pos_seven
```

From this, I could then randomly generate haiku POS templates that I would be able to use with an external set of words.  From the (rather awfully juvenile) example haikus below:

>An old silent pond

>A frog jumps into the pond,

>splash! Silence again.

><br>
>The autumn moonlight

>a large worm digs silently

>into the chestnut.

><br>
>Lightning flashes bright

>what I thought were white faces

>are plumes of plain grass.

The POS tag retrieval for the phrases were:

```
Five Syllable Lines:
        [u'DET', u'ADJ', u'NOUN', u'NOUN'],
        [u'NOUN', u'NOUN', u'NOUN'],
        [u'DET', u'NOUN', u'NOUN'],
        [u'NOUN', u'VERB', u'NOUN'],
        [u'VERB', u'ADV', u'ADP', u'NOUN', u'NOUN'] 

Seven Syllable Lines:
        [u'DET', u'NOUN', u'VERB', u'ADP', u'DET', u'ADJ'],
        [u'DET', u'ADJ', u'NOUN', u'VERB', u'NOUN', u'NOUN'],
        [u'PRON', u'PRON', u'VERB', u'NOUN', u'NOUN']
```

Almost there to our first haiku!

#### 2.2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;First Pass Haiku Generation

I wrote another simple script to take in song lyrics, apply a POS tag for each of the lyrics, and create a word list sorted by the corresponding tags. I could then plug-and-chug words from the generated list into an appropriate slot in the haiku template.

For the first test, I thought it was only appropriate to use lyrics from Drakes classic Started From The Bottom. The output:

```
Story screaming real
Out uncle own stay worry
Through bottom lips heard

When that standing as
Poppin coming we begging
From started keep if

Fucking ball standing
Niggas explaining guys crowd
Say girl chain rumors
```

Oh dear lord, what a mellifluous balance of repulsive vocabulary and lackadaisical grammar! Those were definitely some of the worst haikus Ive read Maybe if I try using Blank Space by Taylor Swift:

```
Half bottom boy flames
Feel what bottom you darling
crying was from is crying

Explaining queen lights
Stays leave could cherry stay
Town cause lets dress the

Crystal blank starts: flames
thats explaining funny hand
Cherry at god im
I lied. Pretty sure those were worse.
```

Obviously, the generated haikus were complete word salad. With absolutely no concept of context or proper grammar, @thehaikuza V0.1 was light years away from reliably generating poems that made at least some remote level of sense. There was definitely more to constructing phrases than stuffing in random words into corresponding POS slots, so I needed another approach.

Hm, I keep hearing about this Markov Chain I wonder if hes related to 2 Chainz?

Click here to read [The Making of Project Haikuza: Part 2](/posts/2015/making-haikuza-ii/)!