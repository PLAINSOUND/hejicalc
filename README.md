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

---

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
By default, 1/1 is the pitch written as A4 in scientific pitch notation (SPN) and its frequency is 440Hz. 

All other tones in the harmonic space are generated from this starting point, multiplying the reference frequency by fractions to produce rational interval (JI) relationships. Harry Partch called this principle *Monophony*, and in *Genesis of a Music*, he describes it as “an organization of musical materials based upon the faculty of the human ear to perceive all intervals and to deduce all principles of musical relationship as an expansion from unity, as 1 is to 1.”

Changing the REFERENCE pitch’s octave, diatonic pitch, and/or accidental automatically updates its frequency—*1/1 frequency (Hz)*—by a 12edo relationship. Once the spelling of 1/1 is specified, its frequency may be adjusted to any desired value.

> *Example.* Selecting *octave* 4, *12edo diatonic note* G, and *12edo accidental* 12edo natural automatically calculates a *1/1 frequency value* 391.9954 Hz. This is one 12edo wholetone (200 cents) below the default values A4 440 Hz (391.9954 = 440 ÷ 2^(2/12)). To work in the harmonic space preferred by Harry Partch, adjust the 1/1 frequency to 392.0000 Hz.

### 2.2	Tuning meter setting
The options under **tuning meter setting** affect how cents values are calculated. The default, *1/1 = 0 cents*, automatically links the value of *tuning meter A4 frequency* and *1/1 Frequency* so that the selected reference note indicates a deviation of 0 cents. Setting *tuning meter A4 frequency = 0 cents* allows the user to specify separate values for *tuning meter A4 frequency* and *1/1 Frequency*; the cents deviation of the selected reference note will be calculated automatically based on its spelling and these two frequency values.

> *Example.* If 1/1 is defined as 10 Hz, and spelled as bE-1, then 440 Hz is partial 44°, about a quartertone below A. If *1/1 = 0 cents* is selected, *tuning meter A4 frequency* will need to be 452.5 Hz. If *tuning meter A4 frequency = 0 cents* is selected, and *tuning meter A4 frequency* is adjusted to 440Hz, notated bE will indicate the tuning meter deviation bE +48.7 cents.

## 3. INPUT
Before making input, one of the following two options must be chosen.
### 3.1	HEJI Notation
An input pitch may be defined according to its octave, diatonic note, and HEJI accidental(s). Palette input accidentals allow up to three Pythagorean apotomes (±) and three steps (±) in each of the prime dimensions 5 through 31.

![Table of symbols](HEJIcalc.png)

### 3.2	JI Ratio
Ratio input comprises two components—
-	the *offset ratio* – a local 1/1 (with respect to the global 1/1 defined in REFERENCE)
-	the *input ratio* – a ratio which is automatically multiplied by the offset ratio
Whole numbers or decimal values may be used; the calculator will automatically convert decimals into whole number fractions when possible.

> *Example.* If the *offset ratio* is 1/1 and the *input ratio* is 10/9, then the OUTPUT is calculated to be 10/9 in relation to the REFERENCE PITCH. If the *offset ratio* is altered to 9/8, then the output is 10/9 in relation to 9/8, compounding the two ratios. Thus, the calculation obtains (10/9)⋅(9/8)  =  5/4 in relation to the REFERENCE.

### 3.3	Moving between input methods
Making changes in an inactive input method will have no effect on the output until that method is made active (i.e. selected). However, calculated outputs (irrespective of the active input method) may be loaded at any time into the *offset ratio* and the *input ratio* fields by means of the load output buttons. This allows pitches from the HEJI notation palette to be easily stored as offset or input values for later use in JI ratio input. Additionally, while input by JI ratio is active, an input interval may easily be stacked multiple times by repeatedly loading the calculated output into the *offset ratio*.

## 4. OUTPUT
The calculator computes information based on the INPUT and REFERENCE PITCH values. Toggling normalise optionally reduces output results to pitch classes by reducing ratios to the span between unison (1/1) and octave (2/1). For example: 3/1 ⇒ 3/2; 1/3 ⇒ 4/3; etc.

### 4.1	HEJI Notation
Corresponding notation of a ratio in terms of the reference pitch, up to the 47-Limit. If the scope of the calculator is exceeded, the message *undefined* is displayed.

### 4.2	Ratio
The calculated output expressed as a ratio of whole numbers with respect to the REFERENCE PITCH. If values become very large, the ratio is automatically converted to a decimal value.

### 4.3	Tuning meter
The output ratio as a microtonal deviation falling within 50 cents of the nearest 12edo chromatic note.

### 4.4	Frequency
The output as a frequency in Hz.

### 4.5	Cents from reference
The size of the output ratio measured in cents.

### 4.6	Software pitch bends
Values for generating microtonal pitch deviations in notation software (Sibelius, Finale, Musescore). The *pb range* depends on the software instrument used. 

Dorico natively supports playback of user-defined microtonal accidentals. To set up HEJI, the first step is to create a new Tonality System with 12000 divisions per octave, achieved by setting the wholetones A–B, C–D, D–E, F–G, and G–A to 2040 divisions and the semitones B–C and E–F to 900 divisions. In principle, this allows for an accuracy of up to 1/10th of a cent while simultaneously defining the diatonic wholetones in terms of the Pythagorean wholetone 8:9 and the diatonic semitones in terms of the Pythagorean limma 243:256. 

Accidental symbols may then be created using font glyphs, which the user associates with *pitch deltas*. Like HEJI accidentals themselves, the software makes use of these deltas to modify the previously defined Pythagorean diatonic notes. Pitch delta values may be easily computed using information computed by the calculator.

To define the deviation of accidentals in a Dorico tonality system, set A as the reference, apply the desired accidental combination from the HEJI input palette with diatonic note A chosen, then use the *cents from reference* value. The pitch delta value is 10 times this cents value. 

## 5. MELODIC DISTANCE
To find the interval between two pitches, computed OUTPUTs may be saved by clicking the load output buttons or ratios may be typed directly into the MELODIC DISTANCE input fields. The calculation is sensitive to the order of input, as ratio II ÷ ratio I. The output ratio—in the form denominator : numerator—expresses melodic distance as a melody between partials in the harmonic/subharmonic series shared by the two input ratios.
