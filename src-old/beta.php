<!DOCTYPE html>
<head>
	<title>Harmonic Space Calculator</title>
	<meta name="description" content="Calculator for traversing 31-limit harmonic space using extended just intonation in Helmholtz-Ellis JI Pitch Notation." />
	<style type="text/css">
	/* FONT LOADS */
	@font-face {
		font-family: "HEJI";
		src: url("HEJI.otf") format("opentype");
	}
	@font-face {
		font-family: "HEJI2Bravura";
		src: url("HEJI2Bravura.otf") format("opentype");
	}	
	@font-face {
		font-family: "Microtonal";
		src: url("Microtonal.TTF") format("truetype");
	}
	</style>
	<link rel="shortcut icon" type="image/icon" href="../images/plainsound_favicon.png"/>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,400i,700" rel="stylesheet"> 
	<link href="CSS_HECalc_beta.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="script_HECalc_beta.js"></script>
</head>
<body onload="sendA()">
	<center>
		<h1> Plainsound Harmonic Space Calculator (Beta)</h1>
		<!-- <a href="info.html">information</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
		<a href="https://www.plainsound.org" target=_blank>plainsound.org</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="johnston.html">JOHNSTON to HE Converter</a><br />
		<br>
		<label for="decimals">calculator precision: </label>
		<select id="precision" class="precision">
	   	    <option value="6">6</option>
	  		<option value="5">5</option>
	    	<option value="4">4</option>
	  		<option value="3">3</option>
	  		<option value="2">2</option>
	  		<option value="1" selected>1</option>
	  		<option value="0">0</option>
		</select> decimal places
		<br><br>
		<table>
			<tr align="center" style="border-bottom: solid 1px gray;">
				<td nowrap style="border-right: solid 1px gray;">
					<h2><b>REFERENCE</b><br />spelling & Hz of 1/1 &nbsp;&bull;&nbsp; EDO</h2>
				</td>
				<td nowrap colspan="2" style="border-right: solid 1px gray;">
					<h2><b>INPUT<br>31-Limit JI &nbsp;&bull;&nbsp; cents/Hz &nbsp;&bull;&nbsp; temperament</b></h2>
				</td>
				<td style="min-width:280px; border-right: solid 1px gray;" nowrap>
					<h2><b>OUTPUT</b><br /><input type="checkbox" name="inputType" id="normalize"> normalise<br /></h2>
				</td>
				<td nowrap style="border-right: solid 1px gray;">
					<h2><b>JI MELODIC DISTANCE</b><br />from ratio I to II<br /></h2>
				</td>
				<td nowrap>
					<h2><b>SCALE BUILDER<br>Scala file format</b></h2>
				</td>
			</tr>
			<tr align="center">
				<td nowrap style="border-right: solid 1px gray;">
					<em>octave (SPN)</em><br />
					<button class="refOctave" value="0">-5</button>
					<button class="refOctave" value="1">-4</button>
					<button class="refOctave" value="2">-3</button>
					<button class="refOctave" value="3">-2</button>
					<button class="refOctave" value="4">-1</button>
					<button class="refOctave" value="5">0</button>
					<button class="refOctave" value="6">1</button>
					<button class="refOctave" value="7">2</button>
					<button class="refOctave" value="8">3</button>
					<button id="defaultRefoctave" class="refOctave selected" value="9">4</button>
					<button class="refOctave" value="10">5</button>
					<button class="refOctave" value="11">6</button>
					<button class="refOctave" value="12">7</button><br />
					<em>tempered diatonic pitch</em><br />
					<button class="refNote" value="0">F</button>
					<button class="refNote" value="1">C</button>
					<button class="refNote" value="2">G</button>
					<button class="refNote" value="3">D</button>
					<button id="defaultRefNote" class="refNote selected" value="4">A</button>
					<button class="refNote" value="5">E</button>
					<button class="refNote" value="6">B</button><br />
					<em>tempered accidental</em><br />
					<button id="refflat" class="refAccidental" value="0">a</button>
					<button id="defaultRefAccidental" class="refAccidental selected" value="1">j</button>
					<button id="refsharp" class="refAccidental" value="2">z</button><br />
					<br />
					<em>1/1 frequency (Hz)</em><br />
					<input type="number" style="text-align:center;font-size:12pt" id="1to1Frequency" value="440.000000"></input>
					<br /><br><br />
					<h2>tuning meter setting</h2>
					<br />
					<input type="radio" name="refInput" id="refFrequencyLinkedRadio" checked><em>1/1 = 0 cents</em><br />
					<input type="radio" name="refInput" id="refFrequencyFreeRadio"><em>1/1 cents relative to A4 setting</em><br />
					<br />
					<em>frequency of A4 on meter</em><br />
					<input type="number" style="text-align:center;font-size:12pt" id="frequencyA4" value="440.000000"></input>
					<br /><br><br />
					<h2>EDO quantisation</h2><br />
					<input type="number" class="edo" style="text-align:center;font-size:12pt" id="edoQuantisation" min="1" step="1" value="53"></input>
					<br />
					<br />
					<br />
					<button id="clearFreq" class="clear" onclick="clearFreq()">reset refs</button>
				</td>
				<td nowrap>
					<h2><b><input type="radio" name="inputType" id="paletteInput" checked> by JI notation palette</b></h2>
					<em>octave (SPN)</em><br />
					<button class="octave" value="0">-5</button>
					<button class="octave" value="1">-4</button>
					<button class="octave" value="2">-3</button>
					<button class="octave" value="3">-2</button>
					<button class="octave" value="4">-1</button>
					<button class="octave" value="5">0</button>
					<button class="octave" value="6">1</button>
					<button class="octave" value="7">2</button>
					<button class="octave" value="8">3</button>
					<button id="defaultOctave" class="octave selected" value="9">4</button>
					<button class="octave" value="10">5</button>
					<button class="octave" value="11">6</button>
					<button class="octave" value="12">7</button>
					<br />
					<em>Pythagorean diatonic pitch</em>
					<br />
					<button class="notes" value="0">F</button>
					<button class="notes" value="1">C</button>
					<button class="notes" value="2">G</button>
					<button class="notes" value="3">D</button>
					<button id="Anatural" class="notes selected" value="4">A</button>
					<button class="notes" value="5">E</button>
					<button class="notes" value="6">B</button> 
					<br /> 
					<em>Helmholtz-Ellis accidental</em>
					<br />
					<button class="chromatic" value="0">eE</button> 
					<button class="chromatic" value="1">E</button> 
					<button class="chromatic" value="2">e</button> 
					<button id="default3" class="chromatic selected" value="3">n</button> 
					<button class="chromatic" value="4">v</button> 
					<button class="chromatic" value="5">V</button> 
					<button class="chromatic" value="6">vV</button> 
					<br />
					<span class="label">5o
					<button class="syntonic" value="0">$</button> 
					<button class="syntonic" value="1">%</button> 
					<button class="syntonic" value="2">&</button> 
					<button id="default5" class="syntonic selected" value="3">n</button> 
					<button class="syntonic" value="4">!</button> 
					<button class="syntonic" value="5">"</button>
					<button class="syntonic" value="6">#</button>
					<span class="label">u5
					<br />
					<span class="label">7o
					<button class="septimal" value="0"><,</button>
					<button class="septimal" value="1">,</button> 
					<button class="septimal" value="2"><</button> 
					<button id="default7" class="septimal selected" value="3">n</button> 
					<button class="septimal" value="4">></button> 
					<button class="septimal" value="5">Q</button>
					<button class="septimal" value="6">>Q</button>
					<span class="label">u7
					<br />
					<span class="label">u11
					<button class="undecimal" value="0">555</button> 
					<button class="undecimal" value="1">55</button> 
					<button class="undecimal" value="2">5</button> 
					<button id="default11" class="undecimal selected" value="3">n</button> 
					<button class="undecimal" value="4">4</button> 
					<button class="undecimal" value="5">44</button>
					<button class="undecimal" value="6">444</button>
					<span class="label">11o
					<br />
					<span class="label">13o
					<button class="tridecimal" value="0">000</button> 
					<button class="tridecimal" value="1">00</button> 
					<button class="tridecimal" value="2">0</button> 
					<button id="default13" class="tridecimal selected" value="3">n</button> 
					<button class="tridecimal" value="4">9</button> 
					<button class="tridecimal" value="5">99</button>
					<button class="tridecimal" value="6">999</button>
					<span class="label">u13
					<br />
					<span class="label">17o
					<button class="seventeen" value="0">:::</button> 
					<button class="seventeen" value="1">::</button> 
					<button class="seventeen" value="2">:</button> 
					<button id="default17" class="seventeen selected" value="3">n</button> 
					<button class="seventeen" value="4">;</button> 
					<button class="seventeen" value="5">;;</button> 
					<button class="seventeen" value="6">;;;</button> 
					<span class="label">u17
					<br />
					<span class="label">u19
					<button class="nineteen" value="0">***</button> 
					<button class="nineteen" value="1">**</button> 
					<button class="nineteen" value="2">*</button> 
					<button id="default19" class="nineteen selected" value="3">n</button> 
					<button class="nineteen" value="4">/</button> 
					<button class="nineteen" value="5">//</button>
					<button class="nineteen" value="6">///</button>
					<span class="label">19o
					<br />
					<span class="label">u23
					<button class="twentyThree" value="0">666</button> 
					<button class="twentyThree" value="1">66</button>  
					<button class="twentyThree" value="2">6</button> 
					<button id="default23" class="twentyThree selected" value="3">n</button> 
					<button class="twentyThree" value="4">3</button> 
					<button class="twentyThree" value="5">33</button> 
					<button class="twentyThree" value="6">333</button> 
					<span class="label">23o
					<br />
					<span class="label">u29
					<button class="twentyNine" value="0">@@@</button> 
					<button class="twentyNine" value="1">@@</button> 
					<button class="twentyNine" value="2">@</button> 
					<button id="default29" class="twentyNine selected" value="3">n</button> 
					<button class="twentyNine" value="4">`</button> 
					<button class="twentyNine" value="5">``</button> 
					<button class="twentyNine" value="6">```</button> 
					<span class="label">29o
					<br />
					<span class="label">31o
					<button class="thirtyOne" value="0">111</button> 
					<button class="thirtyOne" value="1">11</button> 
					<button class="thirtyOne" value="2">1</button> 
					<button id="default31" class="thirtyOne selected" value="3">n</button> 
					<button class="thirtyOne" value="4">8</button> 
					<button class="thirtyOne" value="5">88</button> 
					<button class="thirtyOne" value="6">888</button>
					<span class="label">u31
					<br /><br>
					<button class="clear" onclick="doClear()">reset inputs</button>
				</td>
				<td nowrap style="border-right: solid 1px gray;">
					<h2><b><input type="radio" name="inputType" id="ratioInput"> by JI ratio (offset × input)</b></h2>
					<em>offset ratio</em>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="savedNum" value="1"></input>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="savedDen" value="1"></input>
					<br />
					<button style="font-size:12pt;" id="getCurrentPitch" class="getCurrentPitch" onclick="getCurrentPitch()">load output</button>&nbsp;
					<button style="font-size:12pt;" id="clearSave" class="clearSave" onclick="clearSave()">reset</button>
					<br />
					<em>input ratio</em>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="inputNum" minlength="1" required value="1"></input>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="inputDen"  minlength="1" required value="1"></input>
					<br />
					<button style="font-size:12pt;" id="loadCurrentPitch" class="getCurrentPitch" onclick="loadCurrentPitch()">load output</button>&nbsp;
					<button style="font-size:12pt;" id="clearInputRatio" class="clearInputRatio" onclick="clearInputRatio()">reset</button>
					<script>
						document.querySelectorAll("input[type=number]" && "input[class=ratioIn]").forEach(function (input) {
							input.addEventListener("change", function (e) {
								if (e.target.value == "") {
									e.target.value = 1;
								} else if (e.target.value <= 0) {
									e.target.value = 1;
								}
							})
						})
					</script>
					<br /><br />
					<hr>
					<h2><input type="radio" name="inputType" id="edoStepInput"> by EDO step(s) from reference</h2>
					<input type="number" class="edoInput" style="text-align:center;font-size:12pt" id="edoStepsfromRef" value="0"></input>
					<br />
					<button style="font-size:12pt;" id="clearSave" class="clearSave" onclick="clearEDOInput()">reset</button>
					<hr>
					<h2><input type="radio" name="inputType" id="temperamentInput"> by regular temperament (rank-1)</h2>
					<em>generator</em>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="genNum" value="3"></input>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="genDen" value="2"></input>
					<br />
					<button style="font-size:12pt;" id="clearSave" class="clearSave" onclick="clearGen()">reset</button>
					<br>
					<em>tempering interval</em>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="tempNum" value="80"></input>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="tempDen" value="81"></input>
					<br />
					<button style="font-size:12pt;" id="clearSave" class="getMelodic" onclick="getSyntonicComma()">syntonic</button>
					<button style="font-size:12pt;" id="clearSave" class="getMelodic" onclick="getPythagoreanComma()">Pythag</button>
					<button style="font-size:12pt;" id="clearSave" class="getMelodic" onclick="get8ve()">octave</button>
					<br>
					<em>fraction of tempering interval</em>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="fracNum" value="1"></input>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="fracDen" value="4"></input>
					<br />
					<button style="font-size:12pt;" id="clearSave" class="clearSave" onclick="clearFrac()">reset</button>
					<br>
					<em>iterations of generator</em><br>
					<input type="number" class="edoInput" style="text-align:center;font-size:12pt" id="genIterations" value="0"></input>
					<br />
					<button style="font-size:12pt;" id="clearSave" class="clearSave" onclick="clearGenIterations()">reset</button>
				</td>
				<td nowrap style="border-right: solid 1px gray;">
					<em>ratio</em>
					<br />
					<div style="text-align:center;font-size:18pt;text-decoration:underline" id="num" value="1"></div>
					<div style="text-align:center;font-size:18pt" id="den" value="1"></div>
					<br />
					<em>JI notation</em>
					<em><div id="undefinedNotation"></div></em>
					<br />
					<div style="display: inline" class="notationOutput" id="notationOutput"></div><div style="display: inline" class="noteName" id="noteName"></div>
					<br><br>
					<em>cent deviation (12-EDO)</em>
					<br />
					<div style="font-size:14pt;font-family:'Roboto Condensed';font-style:bold;" id="midiNote"></div>
					<strong><div id="cents" value="0">0</div></strong>
					<em>frequency</em>
					<strong><div type="text" id="frequency" value="440"></div></strong>
					<em>cents from 1/1</em>
					<strong><div id="JIgross" value="0">0</div></strong>
					<em>Tenney harmonic distance (HD)</em>
					<br />
					<strong><div id="hd" value="0">0</div></strong>
					<em>harmonic space coordinates (monzo)</em>
					<br />
					<strong><div id="monzo" value="0">0,0,0,0,0,0,0,0,0,0,0</div></strong>
					<strong><div id="over31Message" value="0"></div></strong>
					<em>step(s) in EDO / cent deviation </em><br />
					<strong><div style="display: inline;" id="edoSteps" value="0">0</div>\<div style="display: inline;" id="edoSize" value="53">53</div></strong>&nbsp;&nbsp;<div style="display: inline;" id="edoCentDeviation" value="0">0</div> cents<br />
					<hr>
					<h2>software pitch bends</h2>
					from
					<select id="bendParameter" class="precision">
				   	    <option value="1">diatonic</option>
				  		<option value="2">chromatic</option> MIDI pitch
				  	</select> MIDI pitch
					<table >
						<tr>
							<td style="text-align: right;">
								<em>Sibelius:</em>
							</td>
							<td width="100">
								<strong><div id="sibelius_bend" value="~B 0,64">~B 0,64</div></strong>
							</td>
						</tr>
						<tr>
							<td style="text-align: right;">
								<em>Finale Pitchwheel:</em>
							</td>
							<td>
								<strong><div id="xbend" value="8192"></div></strong>
							</td>							
						</tr>
						<tr>
							<td style="text-align: right;">
								<em>Musescore:</em>
							</td>
							<td>
								<strong><div id="cents_from_diatonic_tempered" value="0"></div></strong>
							</td>							
						</tr>
					</table>
					<em>arbitrary cents</em>:&nbsp;
					<input type="number" style="text-align:center;font-size:12pt" id="arbitraryCents" value="0"></input>
				
				</td>
				<td nowrap style="border-right: solid 1px gray;">
					<em>ratio I</em>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="melodicRefNum" value="1"></input>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="melodicRefDen" value="1"></input>
					<br />
					<button style="font-size:12pt;" id="getMelodicReference" class="getMelodicReference" onclick="getMelodicReference()">load output</button>&nbsp;
					<button style="font-size:12pt;" id="clearMelodicSave" class="clearMelodicSave" onclick="clearMelodicSave()">reset</button>
					<br />
					<em>ratio II</em>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="checkMelodicNum" value="1"></input>
					<br />
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="checkMelodicDen" value="1"></input>
					<br />
					<button style="font-size:12pt;" id="getMelodic" class="getMelodic" onclick="getMelodicCheck()">load output</button>&nbsp;
					<button style="font-size:12pt;" id="clearMelodic" class="clearMelodic" onclick="clearMelodic()">reset</button>
					<script>
						document.querySelectorAll("input[type=number]" && "input[class=ratioIn]").forEach(function (input) {
							input.addEventListener("change", function (e) {
								if (e.target.value == "") {
									e.target.value = 1;
								} else if (e.target.value <= 0) {
									e.target.value = 1;
								}
							})
						})
					</script>
					<br /><br />
					<em>melodic ratio</em>
					<br />
					<span style="text-align:center;font-size:16pt" id="melodicDen">1</span> : <span style="text-align:center;font-size:16pt;" id="melodicNum">1</span>
					<p style="margin-bottom:-3px;"></p>
					<em>melodic step (cents)</em>
					<br />
					<strong><div id="melodicCents">0.00</div></strong>
					<em>frequency difference</em>
					<br />
					<strong><div id="freqDiff">0.000000</div></strong>
					<em>HD</em>
					<br />
					<strong><div id="melodicHD">0.000000</div></strong>
				</td>
				<td>
					<em>filename</em><br>
					<input type="text" id="filename" value="myscale" style="text-align:right;font-size: 12pt;">.scl<br>
					<button style="font-size:12pt;" id="pushScala" class="getMelodic" onclick="updateFilename()">update</button><br><br>
					<em>short description</em><br>
					<input type="text" id="scalaDescription" value="...A new scale..." style="text-align:center;font-size: 12pt;"><br>
					<button style="font-size:12pt;" id="pushScala" class="getMelodic" onclick="updateDescription()">update</button><br><br>
					<button style="font-size:12pt;" id="pushScala" class="getMelodic" onclick="pushScala()">load output</button>&nbsp;
					<button style="font-size:12pt;" id="clearScala" class="clearMelodic" onclick="clearScala()">reset</button><br><br>

					<em>current # of pitches</em><br>
					<strong><div id="scalaPitches">1</div></strong>
					<button style="font-size:12pt;" id="getMelodic" class="getMelodic" onclick="scalaPreview()">preview</button>

					<br><br>

					<em>remove pitch from scale</em><br>
					<input type="text" id="removeScala" value="b/a" style="text-align:center;font-size: 12pt;"><br>
					<button style="font-size:12pt;" id="clearScala" class="clearMelodic" onclick="removeScala()">remove</button><br><br>
					<hr>

					<a href='#' id="downloadlink">download file</a><br><br>

					<b>Note:</b><br>
					1/1 is implicit in the Scala file format;<br>
					input pitches are automatically normalised<br>
					and sorted, thus scales are octave-repeating.
					
				</td>
			</tr>
		</table>
		<br /><br />
		
		<h2><b>AUTO-NORMALISED ENHARMONIC PITCH-CLASS COMPARISON</b></h2>
		<em>simplified to a Pythagorean notation modified, optionally, by up to<br />
			3 syntonic commas and/or one of the primes 7, 11 or 13, and<br />
			inflected by up to 3 strokes each signifying ca. 1/6-comma<br />
			19° = 512:513 </em>|<em> 17° = 255:256 </em>|<em> 29° = 144:145</em><br /><br />
		<em>primes to include</em><br />
		<input type="checkbox" class="filter3" id="filter3" checked> 3
		&nbsp;
		&nbsp;
		<input type="checkbox" class="filter5" id="filter5" checked> 5
		&nbsp;
		&nbsp;
		<input type="checkbox" class="filter" id="filter7"> 7
		&nbsp;
		&nbsp;
		<input type="checkbox" class="filter" id="filter11"> 11
		&nbsp;
		&nbsp;
		<input type="checkbox" class="filter" id="filter13"> 13
		&nbsp;
		&nbsp;
		<input type="checkbox" class="filterstroke" id="filter17" checked> 17
		&nbsp;
		&nbsp;
		<input type="checkbox" class="filterstroke" id="filter19" checked> 19
		&nbsp;
		&nbsp;
		<input type="checkbox" class="filterstroke" id="filter29" checked> 29
		&nbsp;
		&nbsp;
		<input type="checkbox" class="filter" id="filterall" checked> toggle 17-19-29 (strokes)<br />
		<table>		
			<tr align="center"><td><input type="radio" name="enharmonicInput" id="enharmonicCentsRadio" checked><em>cent input (interval to ref)</em><br />
			<input type="number" style="text-align:center;font-size:12pt;" class="mod1200" id="centreCents" value="0" min="0"></td></tr>
			<tr align="center"><td><input type="button" style="font-size:12pt;" class="getEnharmonic" value="load output" onclick="getCurrentCents()">
			<input type="button" style="font-size:12pt;" class="getEnharmonic" value="save melodic" onclick="getMelodicCents()"><br />
			<input type="radio" name="enharmonicInput" id="enharmonicFrequencyRadio"><em>frequency input (interval to ref)</em><br />
			<input type="number" style="text-align:center;font-size:12pt;" class="freq" id="frequencyInput" value="440" min="1"></td></tr>
			<tr align="center"><td><input type="button" style="font-size:12pt;" class="clearEnharmonic" value="reset inputs" onclick="clearCurrentCF()"><br /><br />

			<em>tolerance range (0 - 1200 c)</em><br />
			<input type="number" style="text-align:center;font-size:12pt;"  class="mod1200" id="rangeCents" value="2" min="0">
			<br />
			<em>minimum & maximum HD values</em><br />
			<input type="number" style="text-align:center;font-size:12pt;" class="positive" id="minHD" value="0" min="0">&nbsp;&nbsp;
			<input type="number" style="text-align:center;font-size:12pt;" class="positive" id="maxHD" value="50" min="0"><br />
			<em>maximum size of output list</em><br />
			<input type="number" step="1" style="text-align:center;font-size:12pt;" class="naturalnumberbox" id="outputSize" value="48" min="0"></td></tr>
			<tr align="center"><td><input type="button" style="font-size:12pt;" class="clearEnharmonic" value="reset filters" onclick="clearFilters()">
			<br /><br />
		<!--<em>limit number of accidentals</em><br />
			<input type="radio" name="accNum" id="acc_1">1&nbsp;&nbsp;
			<input type="radio" name="accNum" id="acc_2" checked>2&nbsp;&nbsp;
			<input type="radio" name="accNum" id="acc_3">3
			<br /> 
		-->
			<input type="radio" name="sorting" id="centSort">sort by cents deviation&nbsp;&nbsp;
			<input type="radio" name="sorting" id="hdSort" checked>sort by HD
			<br />
			<input type="button" style="font-size:14pt;" class="getEnharmonic" value="search" onclick="wipeEnharmonics()"></td></tr>
		</table>
		<script>
				document.querySelectorAll("input[type=number]" && "input[class=mod1200]").forEach(function (input) {
					input.addEventListener("change", function (e) {
						if (e.target.value == "") {
							e.target.value = 0;
						} else if (e.target.value > 1200.0) {
							e.target.value = e.target.value % 1200.0;
						} 
						if (e.target.value < 0.0){
							e.target.value = 1200 - Math.abs(e.target.value);
						}
					})
				})
				document.querySelectorAll("input[type=number]" && "input[class=positive]").forEach(function (input) {
					input.addEventListener("change", function (e) {
						if (e.target.value == "") {
							e.target.value = 0;
						}
						while (e.target.value < 0.0){
							e.target.value = 0.0;
						}
					})
				})
				document.querySelectorAll("input[type=number]" && "input[class=naturalnumberbox]").forEach(function (input) {
					input.addEventListener("change", function (e) {
						if (e.target.value == "") {
							e.target.value = 1;
						} 
						while (e.target.value < 1){
							e.target.value = 1;
						}
						e.target.value = Math.floor(e.target.value);
					})
				})
				document.querySelectorAll("input[type=number]" && "input[class=integerbox]").forEach(function (input) {
					input.addEventListener("change", function (e) {
						if (e.target.value == "") {
							e.target.value = 0;
						}
						if (e.target.value < 0.0) {
							e.target.value = Math.trunc(e.target.value);
						}
						if (e.target.value > 0.0) {
							e.target.value = Math.floor(e.target.value);
						}
					})
				})
				document.querySelectorAll("input[type=number]" && "input[class=edo]").forEach(function (input) {
					input.addEventListener("change", function (e) {
						if (e.target.value == "") {
							e.target.value = 53;
						}
						if (e.target.value < 0) {
							e.target.value = 1;
						}
						if (e.target.value == 0)	{
							e.target.value = 1;
						}
						e.target.value = Math.round(e.target.value)
					})
				})
				document.querySelectorAll("input[type=number]" && "input[class=edoInput]").forEach(function (input) {
					if ($("#edoStepInput").prop("checked")){
						input.addEventListener("change", function (e) {
							if (e.target.value == "") {
								e.target.value = 0;
							}
							e.target.value = Math.round(e.target.value);
						})
					} 
					
				})
			</script>
			<div id="loading"></div>
		<table cellpadding="15">
			<tr>
				<th>3</th>
				<th>5</th>
				<th>7</th>
				<th>11</th>
				<th>13</th>
				<th>17</th>
				<th>19</th>
				<th>23</th>
				<th>29</th>
				<th>ratio</th>
				<th>interval (cents)</th>
				<th>delta (cents)</th>
				<th>HD</th>
				<th>HE notation</th>
				<!-- <th>acc</th>
				<th>pc</th>
				<th>acc3</th> -->
			</tr>
			<tbody align="center" id="data">

			</tbody>
		</table>
		<br />
		<p style="font-size:14px;line-height:130%">
			<a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target=_blank>cc</a> 2020 <a href="http://www.thomasnicholson.ca" target=_blank>Thomas Nicholson</a>, Version 2.3 (13.4.2020)<br />
			developed in collaboration with <a href="http://www.marcsabat.com" target=_blank>Marc Sabat</a> and Rafal Rawicki<br />
			<br />
			<a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target=_blank>Creative Commons Attribution - NonCommercial - ShareAlike</a><br />
		</p>
	</center>
</body>
</html>