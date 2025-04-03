# PLAINSOUND HARMONIC SPACE CALCULATOR
## User Guide | Version 3.5 (2025.04)
### Thomas Nicholson & Marc Sabat
---
## About
The [Plainsound Harmonic Space Calculator](hejicalc.plainsound.org) is a tool for composers and musicians interested in discovering and working with properties of intervals tuned in rational or just intonation (JI).

One of the calculator’s key objectives is to support users of the Helmholtz-Ellis JI Pitch Notation (HEJI), developed by Marc Sabat and Wolfgang von Schweinitz. HEJI is based on a Tertial / Pythagorean series of untempered perfect ﬁfths derived from a reference spelling and frequency (i.e., A4=440Hz) and written on the traditional ﬁve-line staﬀ using ﬂats, naturals, and sharps. It explicitly notates the raising and lowering of these pitches by speciﬁc microtonal ratios associated with a set of visually distinctive symbols based on historical precedents. These additional accidentals may be combined to form strings that show how pitches are tuned according to ratios of specific harmonic partials.

The calculator allows users to compute and compare relative pitch heights of any frequencies based on a chosen reference. Pitches may be entered in HEJI notation and/or as ratios; outputs include HEJI, ratios, absolute cents, tuning meter read-out, software pitch bends, etc.

### Branches / Development Roadmap
The current site source code is published here as the branch "main", and users are welcome to report issues, log feature requests, etc. The branch "dev" is for current development of the next major release, which will integrate playback, sequencing, and integration with scale workshop and hexatone. Timeline for release is end of 2026.


## 1. Introduction
### 1.1	Basic workflow
In general, movement of information through the calculator ﬂows from left to right across the screen on desktop and top to bottom on mobile.

After setting the REFERENCE PITCH (1/1), just intonation relationships—whether as notation or ratios—may be entered into the calculator by selecting either the HEJI notation palette (INPUT 1) or the JI ratio input ﬁelds (INPUT 2).

The calculator computes various types of information about the input, including notation, ratio, tuning meter cent deviation, frequency, software pitch bend values, etc. The results are displayed in the OUTPUT area. The number of decimal places shown may be speciﬁed with the calculator precision drop-down menu.

Additionally, two pitches may be compared to determine their MELODIC DISTANCE (i.e., the interval between them). Ratios may be directly entered in the input ﬁelds or “loaded” by re-routing previously calculated pitches from the OUTPUT area.

### 1.2	System Requirements
The calculator is a simple JavaScript application able to run in any HTML5-compatible web browser on a wide variety of system conﬁgurations. The calculator requires an active connection to the internet to guarantee proper functionality.

On desktop, the app has been optimised for full HD and higher resolution displays (i.e. 1080p or greater). On displays with lower resolutions (e.g. 720p HD), “areas” may reﬂow to form new rows. On mobile, the areas form a single vertical column.


## 2. REFERENCE PITCH
### 2.1	Notation and frequency of 1/1
By default, 1/1 is the pitch written as *ntA4 in scientific pitch notation (SPN) and its frequency is 440Hz. 

All other tones in the harmonic space are generated from this starting point, multiplying the reference frequency by fractions to produce rational interval (JI) relationships. Harry Partch called this principle Monophony, and in Genesis of a Music, he describes it as “an organization of musical materials based upon the faculty of the human ear to perceive all intervals and to deduce all principles of musical relationship as an expansion from unity, as 1 is to 1.”

Changing the REFERENCE pitch’s octave, diatonic pitch, and/or accidental automatically updates its frequency—1/1 frequency (Hz)—by a 12edo relationship. Once the spelling of 1/1 is specified, its frequency may be adjusted to any desired value.

> Example. Selecting octave 4, 12edo diatonic note G, and 12edo accidental *nt automatically calculates a 1/1 frequency value 391.9954 Hz. This is one 12edo wholetone (200 cents) below the default values A4 440 Hz (391.9954 = 440 ÷ 22/12). To work in the harmonic space preferred by Harry Partch, adjust the 1/1 frequency to 392.0000 Hz.



