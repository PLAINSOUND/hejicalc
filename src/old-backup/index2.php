<!DOCTYPE html>
<head>
	<title>31-Limit Extended Helmholtz-Ellis JI Pitch Notation Calculator</title>
	<meta name="description" content="Calculator for traversing 31-limit harmonic space using extended just intonation in Helmholtz-Ellis JI Pitch Notation." />
	<style type="text/css">
	/* FONT LOADS */
	@font-face {
		font-family: "HEJI";
		src: url("HEJI.ttf") format("truetype");
	}
	@font-face {
		font-family: "HEJI2";
		src: url("HEJI2.ttf") format("truetype");
	}  
	@font-face {
		font-family: "Microtonal";
		src: url("Microtonal.TTF") format("truetype");
	}
	</style>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,400i,700" rel="stylesheet"> 
	<link href="CSS_HECalc.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="script_HECalc.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141135227-2"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-141135227-2');
	</script>
</head>
<body onload="doClear();clearFreq()">
	<center>
		<h1> Helmholtz-Ellis 31-Limit Harmonic Space Calculator </h1>
		<a href="info.html">information</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.plainsound.org" target=_blank>plainsound.org</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="johnston.html">JOHNSTON to HE Converter</a><br>
		<br>
		<table>
			<tr align="center">
				<td nowrap>
					<h2><b>REFERENCE</b><br>spelling of 1/1</h2>
				</td>
				<td nowrap>
					<h2><b>INPUT</b><br><input type="radio" name="inputType" id="paletteInput" checked> notation</h2>
				</td>
				<td nowrap>
					<h2><b>INPUT</b><br><input type="radio" name="inputType" id="ratioInput"> ratio</h2>
				</td>
				<td style="min-width:280px" nowrap>
					<h2><b>OUTPUT</b><br><input type="checkbox" name="inputType" id="normalize"> normalise<br></h2>
				</td>
				<td nowrap>
					<h2><b>MELODIC DISTANCE</b><br>from interval A to B<br></h2>
				</td>
			</tr>
			<tr align="center">
				<td nowrap>
					<em>octave</em>
					<br>
					<button class="refOctave" value="0">0</button>
					<button class="refOctave" value="1">1</button>
					<button class="refOctave" value="2">2</button>
					<button class="refOctave" value="3">3</button>
					<button id="defaultRefoctave" class="refOctave selected" value="4">4</button>
					<button class="refOctave" value="5">5</button>
					<button class="refOctave" value="6">6</button>
					<button class="refOctave" value="7">7</button>
					<br>
					<em>diatonic pitch (12 EDO)</em>
					<br>
					<button class="refNote" value="0">F</button>
					<button class="refNote" value="1">C</button>
					<button class="refNote" value="2">G</button>
					<button class="refNote" value="3">D</button>
					<button id="defaultRefNote" class="refNote selected" value="4">A</button>
					<button class="refNote" value="5">E</button>
					<button class="refNote" value="6">B</button> 
					<br>
					<em>accidental (12 EDO)</em>
					<br>
					<button id="refflat" class="refAccidental" value="0">a</button>
					<button id="defaultRefAccidental" class="refAccidental selected" value="1">j</button>
					<button id="refsharp" class="refAccidental" value="2">z</button>
					<br>
					<em>frequency of 1/1 (Hz)</em>
					<br>
					<input type="number" style="text-align:center;font-size:12pt" id="1to1Frequency" value="440.000000"></input>
					<br>
					<em>frequency of A4 (Hz)</em>
					<br>
					<input type="number" style="text-align:center;font-size:12pt" id="frequencyA4" value="440.000000"></input>
					<br>
					<button style="font-size:12pt;" id="clearFreq" class="clearFreq" onclick="clearFreq()">reset</button>
				</td>
				<td nowrap>
					<em>octave</em>
					<br>
					<button class="octave" value="0">0</button>
					<button class="octave" value="1">1</button>
					<button class="octave" value="2">2</button>
					<button class="octave" value="3">3</button>
					<button id="defaultOctave" class="octave selected" value="4">4</button>
					<button class="octave" value="5">5</button>
					<button class="octave" value="6">6</button>
					<button class="octave" value="7">7</button>
					<br>
					<em>diatonic pitch</em>
					<br>
					<button class="notes" value="0">F</button>
					<button class="notes" value="1">C</button>
					<button class="notes" value="2">G</button>
					<button class="notes" value="3">D</button>
					<button id="Anatural" class="notes selected" value="4">A</button>
					<button class="notes" value="5">E</button>
					<button class="notes" value="6">B</button> 
					<br> 
					<em>accidentals</em>
					<br>
					<button class="chromatic" value="0">eE</button> 
					<button class="chromatic" value="1">E</button> 
					<button class="chromatic" value="2">e</button> 
					<button id="default3" class="chromatic selected" value="3">n</button> 
					<button class="chromatic" value="4">v</button> 
					<button class="chromatic" value="5">V</button> 
					<button class="chromatic" value="6">vV</button> 
					<br>
					<span class="label"><span style="text-decoration: overline">5</span></span>
					<button class="syntonic" value="0">$</button> 
					<button class="syntonic" value="1">%</button> 
					<button class="syntonic" value="2">&</button> 
					<button id="default5" class="syntonic selected" value="3">n</button> 
					<button class="syntonic" value="4">!</button> 
					<button class="syntonic" value="5">"</button>
					<button class="syntonic" value="6">#</button>
					<span class="label"><span style="text-decoration: underline">5</span></span>
					<br>
					<span class="label"><span style="text-decoration: overline">7</span></span>
					<button class="septimal" value="0"><,</button>
					<button class="septimal" value="1">,</button> 
					<button class="septimal" value="2"><</button> 
					<button id="default7" class="septimal selected" value="3">n</button> 
					<button class="septimal" value="4">></button> 
					<button class="septimal" value="5">Q</button>
					<button class="septimal" value="6">>Q</button>
					<span class="label"><span style="text-decoration: underline">7</span></span>
					<br>
					<span class="label"><span style="text-decoration: underline">11</span></span>
					<button class="undecimal" value="0">555</button> 
					<button class="undecimal" value="1">55</button> 
					<button class="undecimal" value="2">5</button> 
					<button id="default11" class="undecimal selected" value="3">n</button> 
					<button class="undecimal" value="4">4</button> 
					<button class="undecimal" value="5">44</button>
					<button class="undecimal" value="6">444</button>
					<span class="label"><span style="text-decoration: overline">11</span></span>
					<br>
					<span class="label"><span style="text-decoration: overline">13</span></span>
					<button class="tridecimal" value="0">000</button> 
					<button class="tridecimal" value="1">00</button> 
					<button class="tridecimal" value="2">0</button> 
					<button id="default13" class="tridecimal selected" value="3">n</button> 
					<button class="tridecimal" value="4">9</button> 
					<button class="tridecimal" value="5">99</button>
					<button class="tridecimal" value="6">999</button>
					<span class="label"><span style="text-decoration: underline">13</span></span>
					<br>
					<span class="label"><span style="text-decoration: overline">17</span></span>
					<button class="seventeen" value="0">:::</button> 
					<button class="seventeen" value="1">::</button> 
					<button class="seventeen" value="2">:</button> 
					<button id="default17" class="seventeen selected" value="3">n</button> 
					<button class="seventeen" value="4">;</button> 
					<button class="seventeen" value="5">;;</button> 
					<button class="seventeen" value="6">;;;</button> 
					<span class="label"><span style="text-decoration: underline">17</span></span>
					<br>
					<span class="label"><span style="text-decoration: underline">19</span></span>
					<button class="nineteen" value="0">***</button> 
					<button class="nineteen" value="1">**</button> 
					<button class="nineteen" value="2">*</button> 
					<button id="default19" class="nineteen selected" value="3">n</button> 
					<button class="nineteen" value="4">/</button> 
					<button class="nineteen" value="5">//</button>
					<button class="nineteen" value="6">///</button>
					<span class="label"><span style="text-decoration: overline">19</span></span>
					<br>
					<span class="label"><span style="text-decoration: underline">23</span></span>
					<button class="twentyThree" value="0">666</button> 
					<button class="twentyThree" value="1">66</button>  
					<button class="twentyThree" value="2">6</button> 
					<button id="default23" class="twentyThree selected" value="3">n</button> 
					<button class="twentyThree" value="4">3</button> 
					<button class="twentyThree" value="5">33</button> 
					<button class="twentyThree" value="6">333</button> 
					<span class="label"><span style="text-decoration: overline">23</span></span>
					<br>
					<span class="label"><span style="text-decoration: underline">29</span></span>
					<button class="twentyNine" value="0">@@@</button> 
					<button class="twentyNine" value="1">@@</button> 
					<button class="twentyNine" value="2">@</button> 
					<button id="default29" class="twentyNine selected" value="3">n</button> 
					<button class="twentyNine" value="4">`</button> 
					<button class="twentyNine" value="5">``</button> 
					<button class="twentyNine" value="6">```</button> 
					<span class="label"><span style="text-decoration: overline">29</span></span>
					<br>
					<span class="label"><span style="text-decoration: overline">31</span></span>
					<button class="thirtyOne" value="0">---</button> 
					<button class="thirtyOne" value="1">--</button> 
					<button class="thirtyOne" value="2">-</button> 
					<button id="default31" class="thirtyOne selected" value="3">n</button> 
					<button class="thirtyOne" value="4">+</button> 
					<button class="thirtyOne" value="5">++</button> 
					<button class="thirtyOne" value="6">+++</button>  
					<span class="label"><span style="text-decoration: underline">31</span></span>
					<br>
				</td>
				<td nowrap>
					<em>offset</em>
					<br>
					<input type="number" style="text-align:center;font-size:12pt" id="savedNum" value="1"></input>
					<br>
					<input type="number" style="text-align:center;font-size:12pt" id="savedDen" value="1"></input>
					<br>
					<button style="font-size:12pt;" id="getCurrentPitch" class="getCurrentPitch" onclick="getCurrentPitch()">save output</button>&nbsp;
					<button style="font-size:12pt;" id="clearSave" class="clearSave" onclick="clearSave()">reset</button>
					<br>
					<em>input</em>
					<br>
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="inputNum" minlength="1" required value="1"></input>
					<br>
					<input type="number" style="text-align:center;font-size:12pt" class="ratioIn" id="inputDen"  minlength="1" required value="1"></input>
					<br>
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
					<br>
					<br>
					<br>
					<button class="clear" onclick="doClear();doClear()">clear all</button>
				</td>
				<td nowrap>
					<em>ratio</em>
					<br>
					<div style="text-align:center;font-size:18pt;text-decoration:underline" id="num" value="1"></div>
					<div style="text-align:center;font-size:18pt" id="den" value="1"></div>
					<br>
					<em>notation</em>
					<em><div id="undefinedNotation"></div></em>
					<br>
					<div style="display: inline" class="notationOutput" id="notationOutput"></div><div style="display: inline" class="noteName" id="noteName"></div>
					<br>
					<br>
					<em>cent deviation</em>
					<br>
					<div style="font-size:14pt;font-family:'Roboto Condensed';font-style:bold;" id="midiNote"></div>
					<strong><div id="cents" value="0">0</div></strong>
					<br>
					<em>interval to ref (cents)</em>
					<strong><div id="JIgross" value="0">0</div></strong>
					<em>frequency (Hz)</em>
					<strong><div type="text" id="frequency" value="440">440.000000</div></strong>
					<em>Tenney harmonic distance (HD)</em>
					<br>
					<strong><div id="hd" value="0">0</div></strong>
					<em>monzo (harmonic space coordinates)</em>
					<br>
					<strong><div id="monzo" value="0">0,0,0,0,0,0,0,0,0,0,0</div></strong>
					<strong><div id="over31Message" value="0"></div></strong>
				</td>
				<td nowrap>
					<em>interval A</em>
					<br>
					<input type="number" style="text-align:center;font-size:12pt" id="melodicRefNum" value="1" readonly></input>
					<br>
					<input type="number" style="text-align:center;font-size:12pt" id="melodicRefDen" value="1" readonly></input>
					<br>
					<button style="font-size:12pt;" id="getMelodicReference"class="getMelodicReference" onclick="getMelodicReference()">save output</button>&nbsp;
					<button style="font-size:12pt;" id="clearMelodicSave"class="clearMelodicSave" onclick="clearMelodicSave()">reset</button>
					<br>
					<em>interval B</em>
					<br>
					<input type="number" style="text-align:center;font-size:12pt" id="checkMelodicNum" value="1" readonly></input>
					<br>
					<input type="number" style="text-align:center;font-size:12pt" id="checkMelodicDen" value="1" readonly></input>
					<br>
					<button style="font-size:12pt;" id="getMelodic"class="getMelodic" onclick="getMelodicCheck()">check output</button>
					<br><br>
					<em>melodic ratio</em>
					<br>
					<span style="text-align:center;font-size:16pt" id="melodicDen">1</span> : <span style="text-align:center;font-size:16pt;" id="melodicNum">1</span>
					<p style="margin-bottom:-3px;"></p>
					<em>melodic step (cents)</em>
					<br>
					<strong><div id="melodicCents">0.00</div></strong>
					<em>frequency difference (Hz)</em>
					<br>
					<strong><div id="freqDiff">0.000000</div></strong>
					<em>HD</em>
					<br>
					<strong><div id="melodicHD">0.000000</div></strong>
				</td>
			</tr>
		</table>
		<br><br>
		
		<h2><b>AUTO-NORMALISED ENHARMONIC PITCH-CLASS COMPARISON</b></h2>
		<em>simplified in a Pythagorean notation modified by up to 3 syntonic commas<br />
		and inflected by up to 3 strokes each signifying ca. 1/6-comma<br />
	single = 512:513 </em>|<em> double = 255:256 </em>|<em> triple = 144:145</em><br /><br />
		<em>primes to include</em><br>
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
		<input type="checkbox" class="filter" id="filterall" checked> toggle 17-19-29 (strokes)<br>
		<table>		
			<tr align="center"><td><input type="radio" name="enharmonicInput" id="enharmonicCentsRadio" checked><em>cent input (interval to ref)</em><br>
			<input type="number" style="text-align:center;font-size:12pt;" class="mod1200" id="centreCents" value="0" min="0"></td></tr>
			<tr align="center"><td><input type="button" style="font-size:12pt;" class="getEnharmonic" value="save output" onclick="getCurrentCents()">
			<input type="button" style="font-size:12pt;" class="getEnharmonic" value="save melodic" onclick="getMelodicCents()"><br>
			<input type="radio" name="enharmonicInput" id="enharmonicFrequencyRadio"><em>frequency input (interval to ref)</em><br>
			<input type="number" style="text-align:center;font-size:12pt;" class="freq" id="frequencyInput" value="440" min="1"></td></tr>
			<tr align="center"><td><input type="button" style="font-size:12pt;" class="clearEnharmonic" value="reset inputs" onclick="clearCurrentCF()"><br><br>

			<em>tolerance range (0 - 1200 c)</em><br>
			<input type="number" style="text-align:center;font-size:12pt;"  class="mod1200" id="rangeCents" value="2" min="0">
			<br>
			<em>minimum & maximum HD values</em><br>
			<input type="number" style="text-align:center;font-size:12pt;" class="positive" id="minHD" value="0" min="0">&nbsp;&nbsp;
			<input type="number" style="text-align:center;font-size:12pt;" class="positive" id="maxHD" value="50" min="0"><br>
			<em>maximum size of output list</em><br>
			<input type="number" step="1" style="text-align:center;font-size:12pt;" class="naturalnumberbox" id="outputSize" value="48" min="0"></td></tr>
			<tr align="center"><td><input type="button" style="font-size:12pt;" class="clearEnharmonic" value="reset filters" onclick="clearFilters()">
			<br><br>
		<!--<em>limit number of accidentals</em><br>
			<input type="radio" name="accNum" id="acc_1">1&nbsp;&nbsp;
			<input type="radio" name="accNum" id="acc_2" checked>2&nbsp;&nbsp;
			<input type="radio" name="accNum" id="acc_3">3
			<br> 
		-->
			<input type="radio" name="sorting" id="centSort">sort by cents deviation&nbsp;&nbsp;
			<input type="radio" name="sorting" id="hdSort" checked>sort by HD
			<br>
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
		<br>
		<p style="font-size:14px;line-height:130%">
			<a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target=_blank>cc</a> 2020 <a href="http://www.thomasnicholson.ca" target=_blank>Thomas Nicholson</a>, Version 2.2
			<br>
			Attribution - NonCommercial - ShareAlike
			<br>
			developed in collaboration with <a href="http://www.marcsabat.com" target=_blank>Marc Sabat</a> and Rafal Rawicki
			<br>
			<!-- special thanks to Stefan Bartling whose research and ideas inspired the search for enharmonics -->
		</p>
	</center>
</body>
</html>