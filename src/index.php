<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HARMONIC SPACE CALCULATOR</title>
    
    <link rel="shortcut icon" type="image/icon" href="../images/plainsound_favicon.png"/>
    <link href="style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="script.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141135227-2"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-141135227-2');
	</script>
</head>
<body onload="sendA();preferences();">
    <div class="header">
		<h1>PLAINSOUND HARMONIC SPACE CALCULATOR</h1>
		<span><a href="Plainsound Harmonic Space Calculator.pdf" target="blank">USER GUIDE</a> | <a href="https://github.com/PLAINSOUND/hejicalc" target="blank">GitHub</a></span>
		<br>
		<input type="checkbox" id="theme"> <b> dark theme</b></input>
    </div>

    <div class="precision">
        <label for="decimals">calculator precision: </label>
		<select id="precision">
	   	    <option value="6">6</option>
	  		<option value="5">5</option>
	    	<option value="4">4</option>
	  		<option value="3">3</option>
	  		<option value="2">2</option>
	  		<option value="1" selected>1</option>
	  		<option value="0">0</option>
	    </select> decimal places
    </div>

    <div class="calc-container">
        <div class="refbox">
            <h3><b>REFERENCE PITCH</b><br>notation & frequency of 1/1</h3>
            <br>
            <em>octave (Middle C = C4)</em>
            <br>
               <button class="refOctave" value="1">-4</button><!--
            --><button class="refOctave" value="2">-3</button><!--
            --><button class="refOctave" value="3">-2</button><!--
            --><button class="refOctave" value="4">-1</button><!--
            --><button class="refOctave" value="5">0</button><!--
            --><button class="refOctave" value="6">1</button><!--
            --><button class="refOctave" value="7">2</button><!--
            --><button class="refOctave" value="8">3</button><!--
            --><button id="defaultRefoctave" class="refOctave selected" value="9">4</button><!--
            --><button class="refOctave" value="10">5</button><!--
            --><button class="refOctave" value="11">6</button><!--
            --><button class="refOctave" value="12">7</button><br>
            <em>12edo diatonic note</em><br>
               <button class="refNote" value="0">F</button><!--
            --><button class="refNote" value="1">C</button><!--
            --><button class="refNote" value="2">G</button><!--
            --><button class="refNote" value="3">D</button><!--
            --><button id="defaultRefNote" class="refNote selected" value="4">A</button><!--
            --><button class="refNote" value="5">E</button><!--
            --><button class="refNote" value="6">B</button><br>
            <em>12edo accidental</em><br>
               <button id="refflat" class="refAccidental" value="0">a</button><!--
            --><button id="defaultRefAccidental" class="refAccidental selected" value="1">j</button><!--
            --><button id="refsharp" class="refAccidental" value="2">z</button><br>
            <br>
            <em>1/1 frequency (Hz)</em><br>
            <input type="number" id="1to1Frequency" value="440.000000"></input><br><br>
            <br>
            <h3>tuning meter setting</h3>
            <br>
            <input type="radio" name="refInput" id="refFrequencyLinkedRadio" checked> <em>1/1 = 0 cents</em><br>
            <input type="radio" name="refInput" id="refFrequencyFreeRadio"> <em>tuning meter A4 frequency = 0 cents</em><br>
            <br>
            <em>tuning meter A4 frequency</em><br>
            <input type="number" id="frequencyA4" value="440.000000"></input><br>
			<br>
			<br>
            <button id="clearFreq" class="clear" onclick="clearFreq()">reset reference</button>
        </div>

        <div class="palettebox">
            <h3><b>INPUT 1</b><br><input type="radio" name="inputType" id="paletteInput" checked> HEJI notation</h3>
            <br>
			<div class="palette">
				<h2></h2>
				<em>octave</em>
				<br>
					<button class="octave" value="1">-4</button><!--
				--><button class="octave" value="2">-3</button><!--
				--><button class="octave" value="3">-2</button><!--
				--><button class="octave" value="4">-1</button><!--
				--><button class="octave" value="5">0</button><!--
				--><button class="octave" value="6">1</button><!--
				--><button class="octave" value="7">2</button><!--
				--><button class="octave" value="8">3</button><!--
				--><button id="defaultOctave" class="octave selected" value="9">4</button><!--
				--><button class="octave" value="10">5</button><!--
				--><button class="octave" value="11">6</button><!--
				--><button class="octave" value="12">7</button>
				<br>
				<em>Pythagorean diatonic note</em>
				<br>
					<button class="notes" value="0">F</button><!--
				--><button class="notes" value="1">C</button><!--
				--><button class="notes" value="2">G</button><!--
				--><button class="notes" value="3">D</button><!--
				--><button id="Anatural" class="notes selected" value="4">A</button><!--
				--><button class="notes" value="5">E</button><!--
				--><button class="notes" value="6">B</button> 
				<br> 
				<em>HEJI accidentals</em>
				<br>
					<button class="chromatic" value="0">eE</button><!-- 
				--><button class="chromatic" value="1">E</button><!-- 
				--><button class="chromatic" value="2">e</button><!-- 
				--><button id="default3" class="chromatic selected" value="3">n</button><!-- 
				--><button class="chromatic" value="4">v</button><!-- 
				--><button class="chromatic" value="5">V</button><!-- 
				--><button class="chromatic" value="6">vV</button> 
				<br>
				<span class="label">5°
					<button class="syntonic" value="0">$</button><!-- 
				--><button class="syntonic" value="1">%</button><!-- 
				--><button class="syntonic" value="2">&</button><!-- 
				--><button id="default5" class="syntonic selected" value="3">n</button><!-- 
				--><button class="syntonic" value="4">!</button><!-- 
				--><button class="syntonic" value="5">"</button><!--
				--><button class="syntonic" value="6">#</button>
				<span class="label">u5
				<br>
				<span class="label">7°
					<button class="septimal" value="0"><,</button><!--
				--><button class="septimal" value="1">,</button><!-- 
				--><button class="septimal" value="2"><</button><!-- 
				--><button id="default7" class="septimal selected" value="3">n</button><!-- 
				--><button class="septimal" value="4">></button><!-- 
				--><button class="septimal" value="5">.</button><!--
				--><button class="septimal" value="6">>.</button>
				<span class="label">u7
				<br>
				<span class="label">u11
					<button class="undecimal" value="0">555</button><!-- 
				--><button class="undecimal" value="1">55</button><!-- 
				--><button class="undecimal" value="2">5</button><!-- 
				--><button id="default11" class="undecimal selected" value="3">n</button><!-- 
				--><button class="undecimal" value="4">4</button><!-- 
				--><button class="undecimal" value="5">44</button><!--
				--><button class="undecimal" value="6">444</button>
				<span class="label">11°
				<br>
				<span class="label">13°
					<button class="tridecimal" value="0">000</button><!-- 
				--><button class="tridecimal" value="1">00</button><!-- 
				--><button class="tridecimal" value="2">0</button><!-- 
				--><button id="default13" class="tridecimal selected" value="3">n</button><!-- 
				--><button class="tridecimal" value="4">9</button><!-- 
				--><button class="tridecimal" value="5">99</button><!--
				--><button class="tridecimal" value="6">999</button>
				<span class="label">u13
				<br>
				<span class="label">17°
					<button class="seventeen" value="0">:::</button><!-- 
				--><button class="seventeen" value="1">::</button><!-- 
				--><button class="seventeen" value="2">:</button><!-- 
				--><button id="default17" class="seventeen selected" value="3">n</button><!-- 
				--><button class="seventeen" value="4">;</button><!-- 
				--><button class="seventeen" value="5">;;</button><!-- 
				--><button class="seventeen" value="6">;;;</button> 
				<span class="label">u17
				<br>
				<span class="label">u19
					<button class="nineteen" value="0">***</button><!-- 
				--><button class="nineteen" value="1">**</button><!-- 
				--><button class="nineteen" value="2">*</button><!-- 
				--><button id="default19" class="nineteen selected" value="3">n</button><!-- 
				--><button class="nineteen" value="4">/</button><!-- 
				--><button class="nineteen" value="5">//</button><!--
				--><button class="nineteen" value="6">///</button>
				<span class="label">19°
				<br>
				<span class="label">u23
					<button class="twentyThree" value="0">666</button><!-- 
				--><button class="twentyThree" value="1">66</button><!--  
				--><button class="twentyThree" value="2">6</button><!-- 
				--><button id="default23" class="twentyThree selected" value="3">n</button><!-- 
				--><button class="twentyThree" value="4">3</button><!-- 
				--><button class="twentyThree" value="5">33</button><!-- 
				--><button class="twentyThree" value="6">333</button> 
				<span class="label">23°
				<br>
				<span class="label">u29
					<button class="twentyNine" value="0">777</button><!-- 
				--><button class="twentyNine" value="1">77</button><!-- 
				--><button class="twentyNine" value="2">7</button><!-- 
				--><button id="default29" class="twentyNine selected" value="3">n</button><!-- 
				--><button class="twentyNine" value="4">2</button><!-- 
				--><button class="twentyNine" value="5">22</button><!-- 
				--><button class="twentyNine" value="6">222</button> 
				<span class="label">29°
				<br>
				<span class="label">31°
					<button class="thirtyOne" value="0">111</button><!-- 
				--><button class="thirtyOne" value="1">11</button><!-- 
				--><button class="thirtyOne" value="2">1</button><!-- 
				--><button id="default31" class="thirtyOne selected" value="3">n</button><!-- 
				--><button class="thirtyOne" value="4">8</button><!-- 
				--><button class="thirtyOne" value="5">88</button><!-- 
				--><button class="thirtyOne" value="6">888</button>
				<span class="label">u31
				<br>
				<span class="label">u37
					<button class="thirtySeven" value="0">ààà</button><!-- 
				--><button class="thirtySeven" value="1">àà</button><!-- 
				--><button class="thirtySeven" value="2">à</button><!-- 
				--><button id="default37" class="thirtySeven selected" value="3">n</button><!-- 
				--><button class="thirtySeven" value="4">á</button><!-- 
				--><button class="thirtySeven" value="5">áá</button><!-- 
				--><button class="thirtySeven" value="6">ááá</button>
				<span class="label">37°
				<br>
				<span class="label">u41
					<button class="fortyOne" value="0">---</button><!-- 
				--><button class="fortyOne" value="1">--</button><!-- 
				--><button class="fortyOne" value="2">-</button><!-- 
				--><button id="default41" class="fortyOne selected" value="3">n</button><!-- 
				--><button class="fortyOne" value="4">+</button><!-- 
				--><button class="fortyOne" value="5">++</button><!-- 
				--><button class="fortyOne" value="6">+++</button>
				<span class="label">41°
				<br>
				<span class="label">u43
					<button class="fortyThree" value="0">èèè</button><!-- 
				--><button class="fortyThree" value="1">èè</button><!-- 
				--><button class="fortyThree" value="2">è</button><!-- 
				--><button id="default43" class="fortyThree selected" value="3">n</button><!-- 
				--><button class="fortyThree" value="4">é</button><!-- 
				--><button class="fortyThree" value="5">éé</button><!-- 
				--><button class="fortyThree" value="6">ééé</button>
				<span class="label">43°
				<br>
				<span class="label">47°
					<button class="fortySeven" value="0">&#xee5a;&#xee5a;&#xee5a;</button><!-- 
				--><button class="fortySeven" value="1">&#xee5a;&#xee5a;</button><!-- 
				--><button class="fortySeven" value="2">&#xee5a;</button><!-- 
				--><button id="default47" class="fortySeven selected" value="3">n</button><!-- 
				--><button class="fortySeven" value="4">&#xee5b;</button><!-- 
				--><button class="fortySeven" value="5">&#xee5b;&#xee5b;</button><!-- 
				--><button class="fortySeven" value="6">&#xee5b;&#xee5b;&#xee5b;</button>
				<span class="label">u47
				<br>
            </div>
		</div>

		<div class="ratiobox">
			<h3><b>INPUT 2</b><br><input type="radio" name="inputType" id="ratioInput"> JI ratio (input × offset)</h3>
            <br>
			<em>offset ratio</em>
			<br>
			<input style="border-bottom: solid 1px black;" type="number" class="ratioIn" id="savedNum" value="1"></input>
			<br>
			<input type="number" class="ratioIn" id="savedDen" value="1"></input>
			<br>
			<button id="getCurrentPitch" class="getCurrentPitch" onclick="getCurrentPitch()">load output</button>&nbsp;
			<button id="clearSave" class="clearSave" onclick="clearSave()">reset</button>
			<br>
			<em>input ratio</em>
			<br>
			<input style="border-bottom: solid 1px black;" type="number" class="ratioIn" id="inputNum" minlength="1" required value="1"></input>
			<br>
			<input type="number" class="ratioIn" id="inputDen"  minlength="1" required value="1"></input>
			<br>
			<button id="loadCurrentPitch" class="getCurrentPitch" onclick="loadCurrentPitch()">load output</button>&nbsp;
			<button id="clearInputRatio" class="clearInputRatio" onclick="clearInputRatio()">reset</button>
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
			<button class="clear" onclick="doClear()">reset inputs</button>
        </div>

        <div class="outputbox">
            <h3><b>OUTPUT</b><br>
            <input type="checkbox" name="inputType" id="normalize"> normalise</h3>
            <br>
			<em>HEJI notation</em>
            <em><div id="undefinedNotation"></div></em>
            <div class="notationOutput" id="notationOutput"></div><!--
            --><div class="noteName" id="noteName"></div>
            <br>
			<div class="output-content">
				<em>ratio</em>
				<br>
				<div id="num" value="1"></div>
				<div id="den" value="1"></div>
			</div>
			<div class="output-content">
				<em>tuning meter</em>
				<br>
				<b><div id="midiNote"></div></b>
				<b><div id="cents" value="0"></div></b>
			</div>
			<div class="output-content">
	            <em>frequency</em>
	            <b><div type="text" id="frequency" value="440"></div></b>
			</div>
			<div class="output-content">
	            <em>cents from reference</em>
	            <b><div id="JIgross" value="0">0</div></b>
       		</div>

            <h3 class="software">software pitch bends</h3>
            <p>from nearest
			<select id="bendParameter" class="bendParameter">
				<option value="1">diatonic</option>
				<option value="2">chromatic</option> MIDI pitch
			</select>
			MIDI pitch
			</p>
			<div class="pbrange first">
			<em>Sibelius pb range
			± <select id="sibeliusRange" class="sibeliusRange">
		 		<option value="100">100</option>
				<option value="200" selected>200</option>
				<option value="300">300</option>
				<option value="400">400</option>
				<option value="500">500</option>
				<option value="600">600</option>
				<option value="700">700</option>
				<option value="800">800</option>
				<option value="900">900</option>
				<option value="1000">1000</option>
				<option value="1100">1100</option>
				<option value="1200">1200</option>
			</select> cents</em>
			</div>
            <div class="software-bends">
				<div class="software-type">
					<em>command</em>
				</div>
				<div class="bend">
					<b><div id="sibelius_bend" value="~B 0,64">~B 0,64</div></b>
				</div> 
			</div>
			<div class="pbrange">
			<em>Finale pb range
			± <select id="midiRange" class="midiRange">
				<option value="100">100</option>
				<option value="200">200</option>
				<option value="300">300</option>
				<option value="400">400</option>
				<option value="500">500</option>
				<option value="600">600</option>
				<option value="700">700</option>
				<option value="800">800</option>
				<option value="900">900</option>
				<option value="1000">1000</option>
				<option value="1100">1100</option>
				<option value="1200" selected>1200</option>
			</select> cents</em>
			</div>
			<div class="software-bends">
				<div class="software-type">
					<em>value</em>
				</div>
				<div class="bend">
					<b><div id="xbend" value="8192"></div></b>
				</div> 
			</div>
			<div class="pbrange">
			<em>Musescore “tuning” ± </em>200<em> cents</em>
			</div>
			<div class="software-bends">
				<div class="software-type">
					<em>cent value</em>
				</div>
				<div class="bend">
					<b><div id="musescore_cents" value="0"></div></b>
				</div> 
            </div>
        </div>

        <div class="melodicbox">
            <h3><b>MELODIC DISTANCE</b><br>from ratio I to ratio II</h3>
            <br>
            <em>ratio I</em>
			<br>
			<input type="number" style="border-bottom: solid 1px black;"  class="ratioIn" id="melodicRefNum" value="1"></input>
			<br>
			<input type="number" class="ratioIn" id="melodicRefDen" value="1"></input>
			<br>
			<button id="getMelodicReference" class="getMelodicReference" onclick="getMelodicReference()">load output</button>&nbsp;
			<button id="clearMelodicSave" class="clearMelodicSave" onclick="clearMelodicSave()">reset</button>
			<br>
			<em>ratio II</em>
			<br>
			<input type="number" style="border-bottom: solid 1px black;" class="ratioIn" id="checkMelodicNum" value="1"></input>
			<br>
			<input type="number" class="ratioIn" id="checkMelodicDen" value="1"></input>
			<br>
			<button id="getMelodic" class="getMelodic" onclick="getMelodicCheck()">load output</button>&nbsp;
			<button id="clearMelodic" class="clearMelodic" onclick="clearMelodic()">reset</button>
			<br><br>
			<div class="output-content">
				<em>melodic ratio</em>
				<br>
				<span style="text-align:center;font-size:16pt" id="melodicDen">1</span> : <span style="text-align:center;font-size:16pt;" id="melodicNum">1</span>
				<p style="margin-bottom:-3px;"></p>
			</div>
			<div class="output-content">
				<em>melodic step in cents</em>
				<b><div id="melodicCents">0.00</div></b>
			</div>
			<div class="output-content">
				<em>frequency difference</em>			
				<b><div id="freqDiff">0.000000</div></b>
			</div>
	    </div>

        <div class="scalabox">
            <h2>SCALE BUILDER<br>Scala file format</h2>
            <br>
            <em>filename</em><br>
			<input type="text" id="filename" value="myscale"><br>
			<button id="pushScala" class="getMelodic" onclick="updateFilename()">update</button><br><br>
			<em>short description</em><br>
			<input type="text" id="scalaDescription" value="...A new scale..."><br>
			<button id="pushScala" class="getMelodic" onclick="updateDescription()">update</button><br><br>
			<button id="pushScala" class="getMelodic" onclick="pushScala()">load output</button>&nbsp;
			<button id="clearScala" class="clearMelodic" onclick="clearScala()">reset</button><br><br>

			<em>current # of pitches</em><br>
			<b><div id="scalaPitches">1</div></b>
			<button id="getMelodic" class="getMelodic" onclick="scalaPreview()">preview</button>

			<br><br>

			<em>remove pitch from scale</em><br>
			<input type="text" id="removeScala" value="b/a"><br>
			<button id="clearScala" class="clearMelodic" onclick="removeScala()">remove</button><br><br>

			<a href='#' id="downloadlink">download file</a><br><br>
            
			<b>Note:</b><br>
			1/1 is implicit in the Scala file format;<br>
			input pitches are automatically normalised<br>
			and sorted, thus scales are octave-repeating.
        </div>

    </div>
    <div class="enharmonic-search">
        <h2>AUTO-NORMALISED ENHARMONIC PITCH-CLASS COMPARISON</h2>
		<em>simplified to a Pythagorean notation modified, optionally, by up to<br>
			3 syntonic commas and/or one of the primes 7, 11 or 13, and<br>
			inflected by up to 3 strokes each signifying ca. 1/6-comma<br>
			19° = 512:513 </em>|<em> 17° = 255:256 </em>|<em> 29° = 144:145</em><br><br>
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
        <input type="checkbox" class="filter" id="filterall" checked> toggle 17-19-29 (strokes)
        <br>
        <input type="radio" name="enharmonicInput" id="enharmonicCentsRadio" checked> <em>cent input (interval to ref)</em>
        <br>
        <input type="number" class="mod1200" id="centreCents" value="0" min="0">
        <br>
        <button class="getEnharmonic" onclick="getCurrentCents()">load output</button>
        <button class="getEnharmonic" onclick="getMelodicCents()">save melodic</button>
        <br>
        <input type="radio" name="enharmonicInput" id="enharmonicFrequencyRadio"> <em>frequency input (interval to ref)</em>
        <br>
        <input type="number" class="freq" id="frequencyInput" value="440" min="1">
        <br>
        <button class="clearEnharmonic" onclick="clearCurrentCF()">reset inputs</button>
        <br><br>
        <em>tolerance range (0 - 1200 c)</em><br>
        <input type="number" class="mod1200" id="rangeCents" value="2" min="0">
        <br>
        <em>minimum & maximum HD values</em>
        <br>
        <input type="number" class="positive" id="minHD" value="0" min="0">&nbsp;&nbsp;
        <input type="number" class="positive" id="maxHD" value="50" min="0">
        <br>
        <em>maximum size of output list</em>
        <br>
        <input type="number" step="1" class="naturalnumberbox" id="outputSize" value="48" min="0">
        <br>
        <button class="clearEnharmonic" onclick="clearFilters()">reset filters</button>
        <br><br>
        <input type="radio" name="sorting" id="centSort">sort by cents deviation&nbsp;&nbsp;
        <input type="radio" name="sorting" id="hdSort" checked>sort by HD
        <br>
        <button class="getEnharmonic" onclick="wipeEnharmonics()">search</button>
		<div id="loading"></div>
		<table class="enharmonic-table">
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
			</tr>
			<tbody id="data">

			</tbody>
		</table>

    </div>
    <br><br>
	<footer>
		<p>
			<a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target=_blank>cc</a> 2018&ndash;2020 Thomas Nicholson, Version 3.5 (2025.04)
			<br>
			developed in collaboration with Marc Sabat and Rafa&#322; Rawicki
			<br>
			provided through <a href="https://www.plainsound.org/" target=_blank>PLAINSOUND</a>
		</p>
	</footer>    
</body>
</html>

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
</script>