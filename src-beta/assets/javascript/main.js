"use strict";

/////////////
// Classes //
/////////////

class Factors { // e.g. Notation input via palette
    constructor(powers, remainderNum, remainderDen) {
        this.powers = powers;
        this.remainder = {
            num: remainderNum,
            den: remainderDen
        };
    }
}

class Fraction { // e.g. Ratio input
    constructor(num, den) {
        this.num = num;
        this.den = den;
    }
}

class Unity {
    constructor(factors) {
        this.factors = factors;
        let powers = factors.powers;
        let num = factors.remainder.num;
        let den = factors.remainder.den;
        for (let i = 0; i < primes.length; i++) {
            if (powers[i] > 0) 
                num *= Math.pow(primes[i], powers[i]);
            else 
                den *= Math.pow(primes[i], Math.abs(powers[i]));
        }
        this.fraction = new Fraction(num, den);
    }
}

class Rational extends Unity {
    constructor(factors, fraction) {
        super(factors);
        this.fraction = fraction;
    }
    // Instantiation via Factors 
    static ViaFactors(factors) {
        function getFraction(factors) {
            let powers = factors.powers;
            let num = factors.remainder.num;
            let den = factors.remainder.den;
            for (let i = 0; i < primes.length; i++) {
                if (powers[i] > 0) 
                    num *= Math.pow(primes[i], powers[i]);
                else 
                    den *= Math.pow(primes[i], Math.abs(powers[i]));
            }
            return new Fraction(num, den);
        }
        return new this(factors, getFraction(factors));
    }
    // Instantiation via Fraction
    static ViaFraction(fraction) {
        function getFactors(fraction) {
            let powers = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
            let num = fraction.num;
            let den = fraction.den;
            for (let i = 0; i < primes.length; i++) {
                while (num % primes[i] == 0) {
                    powers[i]++;
                    num /= primes[i];
                }
            }
            for (let i = 0; i < primes.length; i++) {
                while (den % primes[i] == 0) {
                    powers[i]--;
                    den /= primes[i];
                }
            }
            return new Factors(powers, num, den);
        }
        return new this(getFactors(fraction), fraction);
    }
}

/////////////////////////////
// Constants and variables //
/////////////////////////////

const defaultSettings = {
    precision: 1,
    octave: 9,
    diatonic: 4,
    chromatic: 3,
    unityFrequency: 440,
    tuningMeterCents: "zero",
    kammertonFrequency: 440,
    normalise: false,
    midiReference: "diatonic",
    sibeliusRange: 200,
    finaleRange: 1200
};

let sessionSettings = {
    precision: storage("precision") ? storage("precision") : defaultSettings.precision,
    octave: storage("octave") ? storage("octave") : defaultSettings.octave,
    diatonic: storage("diatonic") ? storage("diatonic") : defaultSettings.diatonic,
    chromatic: storage("chromatic") ? storage("chromatic") : defaultSettings.chromatic,
    unityFrequency: storage("unity_frequency") ? storage("unity_frequency") : defaultSettings.unityFrequency,
    tuningMeterCents: storage("tuning_meter_cents") ? storage("tuning_meter_cents") : defaultSettings.tuningMeterCents,
    kammertonFrequency: storage("kammerton_frequency") ? storage("kammerton_frequency") : defaultSettings.kammertonFrequency,
    normalise: storage("normalise") ? boolParse(storage("normalise")) : defaultSettings.normalise,
    midiReference: storage("midi_reference") ? storage("midi_reference") : defaultSettings.midiReference,
    sibeliusRange: storage("sibelius_range") ? storage("sibelius_range") : defaultSettings.sibeliusRange,
    finaleRange: storage("finale_range") ? storage("finale_range") : defaultSettings.finaleRange
};

const rationalReducer = (accumulator, currentValue) => multiplyRationals(accumulator, currentValue);
const arrayReducer = (accumulator, currentValue) => accumulator + currentValue;

const primes = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47];
const hsMap = [0, 1, 4, -2, -1, 3, 7, -3, 6, -2, 0, 2, 4, -1, 6];
let inputMethod = "notation";

// Ratios for button groups
const octave = [
    frac(1, 512),
    frac(1, 256),
    frac(1, 128),
    frac(1, 64),
    frac(1, 32),
    frac(1, 16),
    frac(1, 8),
    frac(1, 4),
    frac(1, 2),
    frac(1, 1),
    frac(2, 1),
    frac(4, 1),
    frac(8, 1)
];
const diatonic = [
    frac(64, 81),
    frac(16, 27),
    frac(8, 9),
    frac(2, 3),
    frac(1, 1),
    frac(3, 2),
    frac(9, 8)
];
const chromatic = [
    frac(8589934592, 10460353203),
    frac(4194304, 4782969),
    frac(2048, 2187),
    frac(1, 1),
    frac(2187, 2048),
    frac(4782969, 4194304),
    frac(10460353203, 8589934592)
];
const prime5 = [
    frac(512000, 531441),
    frac(6400, 6561),
    frac(80, 81),
    frac(1, 1),
    frac(81, 80),
    frac(6561, 6400),
    frac(531441, 512000)
];
const prime7 = [
    frac(250047, 262144),
    frac(3969, 4096),
    frac(63, 64),
    frac(1, 1),
    frac(64, 63),
    frac(4096, 3969),
    frac(262144, 250047)
];
const prime11 = [
    frac(32768, 35937),
    frac(1024, 1089),
    frac(32, 33),
    frac(1, 1),
    frac(33, 32),
    frac(1089, 1024),
    frac(35937, 32768)
];
const prime13 = [
    frac(17576, 19683),
    frac(676, 729),
    frac(26, 27),
    frac(1, 1),
    frac(27, 26),
    frac(729, 676),
    frac(19683, 17576)
];
const prime17 = [
    frac(10303307776, 10460353203),
    frac(4734976, 4782969),
    frac(2176, 2187),
    frac(1, 1),
    frac(2187, 2176),
    frac(4782969, 4734976),
    frac(10460353203, 10303307776)
];
const prime19 = [
    frac(134217728, 135005697),
    frac(262144, 263169),
    frac(512, 513),
    frac(1, 1),
    frac(513, 512),
    frac(263169, 262144),
    frac(135005697, 134217728)
];
const prime23 = [
    frac(387420489, 398688256),
    frac(531441, 541696),
    frac(729, 736),
    frac(1, 1),
    frac(736, 729),
    frac(541696, 531441),
    frac(398688256, 387420489)
];
const prime29 = [
    frac(16777216, 17779581),
    frac(65536, 68121),
    frac(256, 261),
    frac(1, 1),
    frac(261, 256),
    frac(68121, 65536),
    frac(17779581, 16777216)
];
const prime31 = [
    frac(29791, 32768),
    frac(961, 1024),
    frac(31, 32),
    frac(1, 1),
    frac(32, 31),
    frac(1024, 961),
    frac(32768, 29791)
];
const prime37 = [
    frac(46656, 50653),
    frac(1296, 1369),
    frac(36, 37),
    frac(1, 1),
    frac(37, 36),
    frac(1369, 1296),
    frac(50653, 46656)
];
const prime41 = [
    frac(531441, 551368),
    frac(6561, 6724),
    frac(81, 82),
    frac(1, 1),
    frac(82, 81),
    frac(6724, 6561),
    frac(551368, 531441)
];
const prime43 = [
    frac(2097152, 2146689),
    frac(16384, 16641),
    frac(128, 129),
    frac(1, 1),
    frac(129, 128),
    frac(16641, 16384),
    frac(2146689, 2097152)
];
const prime47 = [
    frac(387420489, 425259008),
    frac(531441, 565504),
    frac(729, 752),
    frac(1, 1),
    frac(752, 729),
    frac(565504, 531441),
    frac(425259008, 387420489)
];

// HEJI symbols
const symbols = {
    diatonic: ["F", "C", "G", "D", "A", "E", "B"],
    // fiveDownDownDownDown: ["eI", "I", "K", "M", "O", "R", "vR"],
    fiveDownDownDown: ["*f*Fo125", "*Fo125", "*fo125", "*no125", "*so125", "*So125", "*s*So125"],
    fiveDownDown: ["*f*Fo25", "*Fo25", "*fo25", "*no25", "*so25", "*So25", "*s*So25"],
    fiveDown: ["*f*Fo5", "*Fo5", "*fo5", "*no5", "*so5", "*So5", "*s*So5"],
    pythagorean: ["*f*F", "*F", "*f", "", "*s", "*S", "*s*S"],
    fiveUp: ["*f*Fu5", "*Fu5", "*fu5", "*nu5", "*su5", "*Su5", "*s*Su5"],
    fiveUpUp: ["*f*Fu25", "*Fu25", "*fu25", "*nu25", "*su25", "*Su25", "*s*Su25"],
    fiveUpUpUp: ["*f*Fu125", "*Fu125", "*fu125", "*nu125", "*su125", "*Su125", "*s*Su125"],
    // fiveUpUpUpUp: ["eJ", "J", "L", "N", "P", "Q", "vQ"],
    seven: ["*o7*o49", "*o49", "*o7", "", "*u7", "*u49", "*u7*u49"],
    eleven: ["*u11*u11*u11", "*u11*u11", "*u11", "", "*o11", "*o11*o11", "*o11*o11*o11"],
    thirteen: ["*o13*o13*o13", "*o13*o13", "*o13", "", "*u13", "*u13*u13", "*u13*u13*u13"],
    seventeen: ["*o17*o17*o17", "*o17*o17", "*o17", "", "*u17", "*u17*u17", "*u17*u17*u17"],
    nineteen: ["*u19*u19*u19", "*u19*u19", "*u19", "", "*o19", "*o19*o19", "*o19*o19*o19"],
    twentyThree: ["*u23*u23*u23", "*u23*u23", "*u23", "", "*o23", "*o23*o23", "*o23*o23*o23"],
    twentyNine: ["*u29*u29*u29", "*u29*u29", "*u29", "", "*o29", "*o29*o29", "*o29*o29*o29"],
    thirtyOne: ["*o31*o31*o31", "*o31*o31", "*o31", "", "*u31", "*u31*u31", "*u31*u31*u31"],
    thirtySeven: ["*u37*u37*u37", "*u37*u37", "*u37", "", "*o37", "*o37*o37", "*o37*o37*o37"],
    fortyOne: ["*u41*u41*u41", "*u41*u41", "*u41", "", "*o41", "*o41*o41", "*o41*o41*o41"],
    fortyThree: ["*u43*u43*u43", "*u43*u43", "*u43", "", "*o43", "*o43*o43", "*o43*o43*o43"],
    fortySeven: ["*o47*o47*o47", "*o47*o47", "*o47", "", "*u47", "*u47*u47", "*u47*u47*u47"]
};

const symbolsOLD = {
    diatonic: ["F", "C", "G", "D", "A", "E", "B"],
    fiveDownDownDownDown: ["eI", "I", "K", "M", "O", "R", "vR"],
    fiveDownDownDown: ["eB", "B", "b", "k", "s", "S", "vS"],
    fiveDownDown: ["eC", "C", "c", "l", "t", "T", "vT"],
    fiveDown: ["eD", "D", "d", "m", "u", "U", "vU"],
    pythagorean: ["eE", "E", "e", "", "v", "V", "vV"],
    fiveUp: ["eF", "F", "f", "o", "w", "W", "vW"],
    fiveUpUp: ["eG", "G", "g", "p", "x", "X", "vX"],
    fiveUpUpUp: ["eH", "H", "h", "q", "y", "Y", "vY"],
    fiveUpUpUpUp: ["eJ", "J", "L", "N", "P", "Q", "vQ"],
    seven: ["&lt;,", ",", "&lt;", "", ">", ".", ">."],
    eleven: ["555", "55", "5", "", "4", "44", "444"],
    thirteen: ["000", "00", "0", "", "9", "99", "999"],
    seventeen: [":::", "::", ":", "", ";", ";;", ";;;"],
    nineteen: ["È", "À", "*", "", "/", "Á", "É"],
    twentyThree: ["666", "66", "6", "", "3", "33", "333"],
    twentyNine: ["777", "77", "7", "", "2", "22", "222"],
    thirtyOne: ["111", "11", "1", "", "8", "88", "888"],
    thirtySeven: ["ààà", "àà", "à", "", "á", "áá", "ááá"],
    fortyOne: ["---", "--", "-", "", "+", "++", "+++"],
    fortyThree: ["èèè", "èè", "è", "", "é", "éé", "ééé"],
    fortySeven: ["ììì", "ìì", "ì", "", "í", "íí", "ííí"]
};

let consent = storage("storage_consent");

// Unput arrays

let unityArray = [
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
]

let paletteArray = [
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1),
    frac(1, 1)
]

/////////////////////
// Event listeners //
/////////////////////

// Settings 
$("#settings-precision").on("change", function() {
    const newVal = $(this).val();
    if (consent)
        store("precision", newVal);
    sessionSettings.precision = newVal;
});

$(".settings-octave-btn").on("click", function () {
    $(".settings-octave-btn").removeClass("selected");
    $(this).addClass("selected");
    const newVal = $(this).val();
    if (consent)
        store("octave", newVal);
    sessionSettings.octave = newVal;
    unityArray[0] = octave[$(this).val()];
});

$(".settings-diatonic-btn").on("click", function () {
    $(".settings-diatonic-btn").removeClass("selected");
    $(this).addClass("selected");
    const newVal = $(this).val();
    if (consent)
        store("diatonic", newVal);
    sessionSettings.diatonic = newVal;
    unityArray[1] = diatonic[$(this).val()];
});

$(".settings-chromatic-btn").on("click", function () {
    $(".settings-chromatic-btn").removeClass("selected");
    $(this).addClass("selected");
    const newVal = $(this).val();
    if (consent)
        store("chromatic", newVal);
    sessionSettings.chromatic = newVal;
    unityArray[3] = chromatic[$(this).val()];
});

$("#settings-unity-frequency").on("change", function () {
    const newVal = $(this).val();
    if (consent)
        store("unity_frequency", newVal);
    sessionSettings.unityFrequency = newVal;
});

$("input[name='settings-tuning-meter']").on("click", function () {
    const newVal = $(this).val();
    if (consent)
        store("tuning_meter_cents", newVal);
    sessionSettings.tuningMeterCents = newVal;
});

$("#settings-kammerton-frequency").on("change", function () {
    const newVal = $(this).val();
    if (consent)
        store("kammerton_frequency", newVal);
    sessionSettings.kammertonFrequency = newVal;
});

$("#settings-normalise").on("click", function () {
    let newVal;
    if ($(this).is(":checked")) {
        newVal = true;
    } else {
        newVal = false;
    }
    if (consent)
        store("normalise", newVal);
    sessionSettings.normalise = newVal;
});

$("input[name='settings-pb-midi-pitch']").on("click", function () {
    const newVal = $(this).val();
    if (consent)
        store("midi_reference", newVal);
    sessionSettings.midiReference = newVal;
});

$("#settings-sibelius-pb-range").on("change", function() {
    const newVal = $(this).val();
    if (consent)
        store("sibelius_range", newVal);
    sessionSettings.sibeliusRange = newVal;
});

$("#settings-finale-pb-range").on("change", function() {
    const newVal = $(this).val();
    if (consent)
        store("finale_range", newVal);
    sessionSettings.finaleRange = newVal;
});

$("#settings-reset").on("click", function () {
    if (consent) {
        localStorage.clear();
        store("storage_consent", true);
    }
    sessionSettings.precision = defaultSettings.precision;
    sessionSettings.octave = defaultSettings.octave;
    sessionSettings.diatonic = defaultSettings.diatonic;
    sessionSettings.chromatic = defaultSettings.chromatic;
    sessionSettings.unityFrequency = defaultSettings.unityFrequency;
    sessionSettings.tuningMeterCents = defaultSettings.tuningMeterCents;
    sessionSettings.kammertonFrequency = defaultSettings.kammertonFrequency;
    sessionSettings.normalise = defaultSettings.normalise;
    sessionSettings.midiReference = defaultSettings.midiReference;
    sessionSettings.sibeliusRange = defaultSettings.sibeliusRange;
    sessionSettings.finaleRange = defaultSettings.finaleRange;
    loadDefaultSettings();
});

// If unity = 0 cents, disable Kammerton input
$("#settings-unity-0-cents").click(function () {
    if (this.checked) {
        $("#settings-kammerton-frequency").prop("disabled", true);
        $("#settings-kammerton-frequency").css("background", "#E6E8F0");
    }
});

// If unity cents relative to tuning meter, enable Kammerton input
$("#settings-unity-cents-relative").click(function() {
    if (this.checked) {
        $("#settings-kammerton-frequency").prop("disabled", false);
        $("#settings-kammerton-frequency").css("background", "#F2F3F7");
    }
});

// Tabs
$("#settings").on("click", function () {
    openModal('#settings-modal');
});

$("#close-settings").on("click", function () {
    closeModal("#settings-modal");
    calculate();
});

$("#info").on("click", function () {
    openModal('#info-modal');
});

$("#close-info").on("click", function () {
    closeModal("#info-modal");
});

$("#notation-tab").on("click", function () {
    openFragment("notation-tab", "notation-fragment");
});

$("#ratio-tab").on("click", function () {
    openFragment("ratio-tab", "ratio-fragment");
});

$("#compare-tab").on("click", function () {
    openFragment("compare-tab", "melodic-fragment");
});

$("#calculate-tab").on("click", function () {
    openFragment("calculate-tab", "calculate-fragment");
    calculate();
});

// Notation input
$(".octave-btn").on("click", function() {
    $(".octave-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[0] = octave[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".diatonic-btn").on("click", function() {
    $(".diatonic-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[1] = diatonic[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".pythagorean-btn").on("click", function() {
    $(".pythagorean-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[2] = chromatic[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".five-btn").on("click", function() {
    $(".five-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[3] = prime5[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".seven-btn").on("click", function() {
    $(".seven-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[4] = prime7[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".eleven-btn").on("click", function() {
    $(".eleven-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[5] = prime11[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".thirteen-btn").on("click", function() {
    $(".thirteen-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[6] = prime13[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".seventeen-btn").on("click", function() {
    $(".seventeen-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[7] = prime17[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".nineteen-btn").on("click", function() {
    $(".nineteen-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[8] = prime19[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".twentythree-btn").on("click", function() {
    $(".twentythree-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[9] = prime23[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".twentynine-btn").on("click", function() {
    $(".twentynine-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[10] = prime29[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".thirtyone-btn").on("click", function() {
    $(".thirtyone-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[11] = prime31[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".thirtyseven-btn").on("click", function() {
    $(".thirtyseven-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[12] = prime37[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".fortyone-btn").on("click", function() {
    $(".fortyone-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[13] = prime41[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".fortythree-btn").on("click", function() {
    $(".fortythree-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[14] = prime43[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$(".fortyseven-btn").on("click", function() {
    $(".fortyseven-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[15] = prime47[$(this).val()];
    inputMethod = "notation";
    calculate();
});

$("#notation-reset").on("click", function() {
    loadNotationInput();
    calculate();
});

// Local storage consent
$("#accept").click(function () {
    store("storage_consent", true);
    $("#consent-modal").addClass("hidden");
    consent = storage("storage_consent");
    loadDefaultSettings();
});

$("#next-time").click(function () {
    $("#consent-modal").addClass("hidden");
});

///////////////
// Functions //
///////////////

// JI functions
function getCents(num, den) {
    return (1200 * Math.log2(num / den));
}

function getDiatonicNote(powers) {
    const fifthsCount = getFifthsCount(powers);
    const pc = mod((fifthsCount + 4), 7);
    const diatonicNote = symbols.diatonic[pc];
    return diatonicNote;
}

function getAccidentals(factors) {
    const powers = factors.powers;
    const chromaticCount = getFifthsCount(powers) + 25;
    let accidentals = {
        natural: "",
        pythagorean: "overflow",
        seven: "overflow",
        eleven: "overflow",
        thirteen: "overflow",
        seventeen: "overflow",
        nineteen: "overflow",
        twentyThree: "overflow",
        twentyNine: "overflow",
        thirtyOne: "overflow",
        thirtySeven: "overflow",
        fortyOne: "overflow",
        fortyThree: "overflow",
        fortySeven: "overflow"
    };
    // Natural
    if ((powers[1] == -4 ||
        powers[1] == -3 ||
        powers[1] == -2 ||
        powers[1] == -1 ||
        powers[1] == 0 ||
        powers[1] == 1 ||
        powers[1] == 2) &&
        powers[2] == 0 &&
        powers[3] == 0 &&
        powers[4] == 0 &&
        powers[5] == 0 &&
        powers[6] == 0 &&
        powers[7] == 0 &&
        powers[8] == 0 &&
        powers[9] == 0 &&
        powers[10] == 0 &&
        powers[11] == 0 &&
        powers[12] == 0 &&
        powers[13] == 0 &&
        powers[14] == 0) accidentals.natural = "*n";
    // Primes 3 and 5
    switch (powers[2]) {
        case -4:
            if (chromaticCount >= 0 && chromaticCount <= 6)
                accidentals.pythagorean = fiveUpUpUpUpSymbols[0];
            if (chromaticCount >= 7 && chromaticCount <= 13)
                accidentals.pythagorean = fiveUpUpUpUpSymbols[1];
            if (chromaticCount >= 14 && chromaticCount <= 20)
                accidentals.pythagorean = fiveUpUpUpUpSymbols[2];
            if (chromaticCount >= 21 && chromaticCount <= 27)
                accidentals.pythagorean = fiveUpUpUpUpSymbols[3];
            if (chromaticCount >= 28 && chromaticCount <= 34)
                accidentals.pythagorean = fiveUpUpUpUpSymbols[4];
            if (chromaticCount >= 35 && chromaticCount <= 41)
                accidentals.pythagorean = fiveUpUpUpUpSymbols[5];
            if (chromaticCount >= 42 && chromaticCount <= 48)
                accidentals.pythagorean = fiveUpUpUpUpSymbols[6];
            break;
        case -3:
            if (chromaticCount >= 0 && chromaticCount <= 6)
                accidentals.pythagorean = symbols.fiveUpUpUp[0];
            if (chromaticCount >= 7 && chromaticCount <= 13)
                accidentals.pythagorean = symbols.fiveUpUpUp[1];
            if (chromaticCount >= 14 && chromaticCount <= 20)
                accidentals.pythagorean = symbols.fiveUpUpUp[2];
            if (chromaticCount >= 21 && chromaticCount <= 27)
                accidentals.pythagorean = symbols.fiveUpUpUp[3];
            if (chromaticCount >= 28 && chromaticCount <= 34)
                accidentals.pythagorean = symbols.fiveUpUpUp[4];
            if (chromaticCount >= 35 && chromaticCount <= 41)
                accidentals.pythagorean = symbols.fiveUpUpUp[5];
            if (chromaticCount >= 42 && chromaticCount <= 48)
                accidentals.pythagorean = symbols.fiveUpUpUp[6];
            break;
        case -2:
            if (chromaticCount >= 0 && chromaticCount <= 6)
                accidentals.pythagorean = symbols.fiveUpUp[0];
            if (chromaticCount >= 7 && chromaticCount <= 13)
                accidentals.pythagorean = symbols.fiveUpUp[1];
            if (chromaticCount >= 14 && chromaticCount <= 20)
                accidentals.pythagorean = symbols.fiveUpUp[2];
            if (chromaticCount >= 21 && chromaticCount <= 27)
                accidentals.pythagorean = symbols.fiveUpUp[3];
            if (chromaticCount >= 28 && chromaticCount <= 34)
                accidentals.pythagorean = symbols.fiveUpUp[4];
            if (chromaticCount >= 35 && chromaticCount <= 41)
                accidentals.pythagorean = symbols.fiveUpUp[5];
            if (chromaticCount >= 42 && chromaticCount <= 48)
                accidentals.pythagorean = symbols.fiveUpUp[6];
            break;
        case -1:
            if (chromaticCount >= 0 && chromaticCount <= 6)
                accidentals.pythagorean = symbols.fiveUp[0];
            if (chromaticCount >= 7 && chromaticCount <= 13)
                accidentals.pythagorean = symbols.fiveUp[1];
            if (chromaticCount >= 14 && chromaticCount <= 20)
                accidentals.pythagorean = symbols.fiveUp[2];
            if (chromaticCount >= 21 && chromaticCount <= 27)
                accidentals.pythagorean = symbols.fiveUp[3];
            if (chromaticCount >= 28 && chromaticCount <= 34)
                accidentals.pythagorean = symbols.fiveUp[4];
            if (chromaticCount >= 35 && chromaticCount <= 41)
                accidentals.pythagorean = symbols.fiveUp[5];
            if (chromaticCount >= 42 && chromaticCount <= 48)
                accidentals.pythagorean = symbols.fiveUp[6];
            break;
        case 0:
            if (chromaticCount >= 0 && chromaticCount <= 6)
                accidentals.pythagorean = symbols.pythagorean[0];
            if (chromaticCount >= 7 && chromaticCount <= 13)
                accidentals.pythagorean = symbols.pythagorean[1];
            if (chromaticCount >= 14 && chromaticCount <= 20)
                accidentals.pythagorean = symbols.pythagorean[2];
            if (chromaticCount >= 21 && chromaticCount <= 27)
                accidentals.pythagorean = symbols.pythagorean[3];
            if (chromaticCount >= 28 && chromaticCount <= 34)
                accidentals.pythagorean = symbols.pythagorean[4];
            if (chromaticCount >= 35 && chromaticCount <= 41)
                accidentals.pythagorean = symbols.pythagorean[5];
            if (chromaticCount >= 42 && chromaticCount <= 48)
                accidentals.pythagorean = symbols.pythagorean[6];
            break;
        case 1:
            if (chromaticCount >= 0 && chromaticCount <= 6)
                accidentals.pythagorean = symbols.fiveDown[0];
            if (chromaticCount >= 7 && chromaticCount <= 13)
                accidentals.pythagorean = symbols.fiveDown[1];
            if (chromaticCount >= 14 && chromaticCount <= 20)
                accidentals.pythagorean = symbols.fiveDown[2];
            if (chromaticCount >= 21 && chromaticCount <= 27)
                accidentals.pythagorean = symbols.fiveDown[3];
            if (chromaticCount >= 28 && chromaticCount <= 34)
                accidentals.pythagorean = symbols.fiveDown[4];
            if (chromaticCount >= 35 && chromaticCount <= 41)
                accidentals.pythagorean = symbols.fiveDown[5];
            if (chromaticCount >= 42 && chromaticCount <= 48)
                accidentals.pythagorean = symbols.fiveDown[6];
            break;
        case 2:
            if (chromaticCount >= 0 && chromaticCount <= 6)
                accidentals.pythagorean = symbols.fiveDownDown[0];
            if (chromaticCount >= 7 && chromaticCount <= 13)
                accidentals.pythagorean = symbols.fiveDownDown[1];
            if (chromaticCount >= 14 && chromaticCount <= 20)
                accidentals.pythagorean = symbols.fiveDownDown[2];
            if (chromaticCount >= 21 && chromaticCount <= 27)
                accidentals.pythagorean = symbols.fiveDownDown[3];
            if (chromaticCount >= 28 && chromaticCount <= 34)
                accidentals.pythagorean = symbols.fiveDownDown[4];
            if (chromaticCount >= 35 && chromaticCount <= 41)
                accidentals.pythagorean = symbols.fiveDownDown[5];
            if (chromaticCount >= 42 && chromaticCount <= 48)
                accidentals.pythagorean = symbols.fiveDownDown[6];
            break;
        case 3:
            if (chromaticCount >= 0 && chromaticCount <= 6)
                accidentals.pythagorean = symbols.fiveDownDownDown[0];
            if (chromaticCount >= 7 && chromaticCount <= 13)
                accidentals.pythagorean = symbols.fiveDownDownDown[1];
            if (chromaticCount >= 14 && chromaticCount <= 20)
                accidentals.pythagorean = symbols.fiveDownDownDown[2];
            if (chromaticCount >= 21 && chromaticCount <= 27)
                accidentals.pythagorean = symbols.fiveDownDownDown[3];
            if (chromaticCount >= 28 && chromaticCount <= 34)
                accidentals.pythagorean = symbols.fiveDownDownDown[4];
            if (chromaticCount >= 35 && chromaticCount <= 41)
                accidentals.pythagorean = symbols.fiveDownDownDown[5];
            if (chromaticCount >= 42 && chromaticCount <= 48)
                accidentals.pythagorean = symbols.fiveDownDownDown[6];
            break;
        case 4:
            if (chromaticCount >= 0 && chromaticCount <= 6)
                accidentals.pythagorean = symbols.fiveDownDownDownDown[0];
            if (chromaticCount >= 7 && chromaticCount <= 13)
                accidentals.pythagorean = symbols.fiveDownDownDownDown[1];
            if (chromaticCount >= 14 && chromaticCount <= 20)
                accidentals.pythagorean = symbols.fiveDownDownDownDown[2];
            if (chromaticCount >= 21 && chromaticCount <= 27)
                accidentals.pythagorean = symbols.fiveDownDownDownDown[3];
            if (chromaticCount >= 28 && chromaticCount <= 34)
                accidentals.pythagorean = symbols.fiveDownDownDownDown[4];
            if (chromaticCount >= 35 && chromaticCount <= 41)
                accidentals.pythagorean = symbols.fiveDownDownDownDown[5];
            if (chromaticCount >= 42 && chromaticCount <= 48)
                accidentals.pythagorean = symbols.fiveDownDownDownDown[6];
            break;
    }
    // Prime 7
    switch (powers[3]) {
        case -3:
            accidentals.seven = symbols.seven[6];
            break;
        case -2:
            accidentals.seven = symbols.seven[5];
            break;
        case -1:
            accidentals.seven = symbols.seven[4];
            break;
        case 0:
            accidentals.seven = symbols.seven[3];
            break;
        case 1:
            accidentals.seven = symbols.seven[2];
            break;
        case 2:
            accidentals.seven = symbols.seven[1];
            break;
        case 3:
            accidentals.seven = symbols.seven[0];
            break;
    }
    // Prime 11
    switch (powers[4]) {
        case -3:
            accidentals.eleven = symbols.eleven[0];
            break;
        case -2:
            accidentals.eleven = symbols.eleven[1];
            break;
        case -1:
            accidentals.eleven = symbols.eleven[2];
            break;
        case 0:
            accidentals.eleven = symbols.eleven[3];
            break;
        case 1:
            accidentals.eleven = symbols.eleven[4];
            break;
        case 2:
            accidentals.eleven = symbols.eleven[5];
            break;
        case 3:
            accidentals.eleven = symbols.eleven[6];
            break;
    }
    // Prime 13
    switch (powers[5]) {
        case -3:
            accidentals.thirteen = symbols.thirteen[6];
            break;
        case -2:
            accidentals.thirteen = symbols.thirteen[5];
            break;
        case -1:
            accidentals.thirteen = symbols.thirteen[4];
            break;
        case 0:
            accidentals.thirteen = symbols.thirteen[3];
            break;
        case 1:
            accidentals.thirteen = symbols.thirteen[2];
            break;
        case 2:
            accidentals.thirteen = symbols.thirteen[1];
            break;
        case 3:
            accidentals.thirteen = symbols.thirteen[0];
            break;
    }
    // Prime 17
    switch (powers[6]) {
        case -3:
            accidentals.seventeen = symbols.seventeen[6];
            break;
        case -2:
            accidentals.seventeen = symbols.seventeen[5];
            break;
        case -1:
            accidentals.seventeen = symbols.seventeen[4];
            break;
        case 0:
            accidentals.seventeen = symbols.seventeen[3];
            break;
        case 1:
            accidentals.seventeen = symbols.seventeen[2];
            break;
        case 2:
            accidentals.seventeen = symbols.seventeen[1];
            break;
        case 3:
            accidentals.seventeen = symbols.seventeen[0];
            break;
    }
    // Prime 19
    switch (powers[7]) {
        case -3:
            accidentals.nineteen = symbols.nineteen[0];
            break;
        case -2:
            accidentals.nineteen = symbols.nineteen[1];
            break;
        case -1:
            accidentals.nineteen = symbols.nineteen[2];
            break;
        case 0:
            accidentals.nineteen = symbols.nineteen[3];
            break;
        case 1:
            accidentals.nineteen = symbols.nineteen[4];
            break;
        case 2:
            accidentals.nineteen = symbols.nineteen[5];
            break;
        case 3:
            accidentals.nineteen = symbols.nineteen[6];
            break;
    }
    // Prime 23
    switch (powers[8]) {
        case -3:
            accidentals.twentyThree = symbols.twentyThree[0];
            break;
        case -2:
            accidentals.twentyThree = symbols.twentyThree[1];
            break;
        case -1:
            accidentals.twentyThree = symbols.twentyThree[2];
            break;
        case 0:
            accidentals.twentyThree = symbols.twentyThree[3];
            break;
        case 1:
            accidentals.twentyThree = symbols.twentyThree[4];
            break;
        case 2:
            accidentals.twentyThree = symbols.twentyThree[5];
            break;
        case 3:
            accidentals.twentyThree = symbols.twentyThree[6];
            break;
    }
    // Prime 29
    switch (powers[9]) {
        case -3:
            accidentals.twentyNine = symbols.twentyNine[0];
            break;
        case -2:
            accidentals.twentyNine = symbols.twentyNine[1];
            break;
        case -1:
            accidentals.twentyNine = symbols.twentyNine[2];
            break;
        case 0:
            accidentals.twentyNine = symbols.twentyNine[3];
            break;
        case 1:
            accidentals.twentyNine = symbols.twentyNine[4];
            break;
        case 2:
            accidentals.twentyNine = symbols.twentyNine[5];
            break;
        case 3:
            accidentals.twentyNine = symbols.twentyNine[6];
            break;
    }
    // Prime 31
    switch (powers[10]) {
        case -3:
            accidentals.thirtyOne = symbols.thirtyOne[6];
            break;
        case -2:
            accidentals.thirtyOne = symbols.thirtyOne[5];
            break;
        case -1:
            accidentals.thirtyOne = symbols.thirtyOne[4];
            break;
        case 0:
            accidentals.thirtyOne = symbols.thirtyOne[3];
            break;
        case 1:
            accidentals.thirtyOne = symbols.thirtyOne[2];
            break;
        case 2:
            accidentals.thirtyOne = symbols.thirtyOne[1];
            break;
        case 3:
            accidentals.thirtyOne = symbols.thirtyOne[0];
            break;
    }
    // Prime 37
    switch (powers[11]) {
        case -3:
            accidentals.thirtySeven = symbols.thirtySeven[0];
            break;
        case -2:
            accidentals.thirtySeven = symbols.thirtySeven[1];
            break;
        case -1:
            accidentals.thirtySeven = symbols.thirtySeven[2];
            break;
        case 0:
            accidentals.thirtySeven = symbols.thirtySeven[3];
            break;
        case 1:
            accidentals.thirtySeven = symbols.thirtySeven[4];
            break;
        case 2:
            accidentals.thirtySeven = symbols.thirtySeven[5];
            break;
        case 3:
            accidentals.thirtySeven = symbols.thirtySeven[6];
            break;
    }
    // Prime 41
    switch (powers[12]) {
        case -3:
            accidentals.fortyOne = symbols.fortyOne[0];
            break;
        case -2:
            accidentals.fortyOne = symbols.fortyOne[1];
            break;
        case -1:
            accidentals.fortyOne = symbols.fortyOne[2];
            break;
        case 0:
            accidentals.fortyOne = symbols.fortyOne[3];
            break;
        case 1:
            accidentals.fortyOne = symbols.fortyOne[4];
            break;
        case 2:
            accidentals.fortyOne = symbols.fortyOne[5];
            break;
        case 3:
            accidentals.fortyOne = symbols.fortyOne[6];
            break;
    }
    // Prime 43
    switch (powers[13]) {
        case -3:
            accidentals.fortyThree = symbols.fortyThree[0];
            break;
        case -2:
            accidentals.fortyThree = symbols.fortyThree[1];
            break;
        case -1:
            accidentals.fortyThree = symbols.fortyThree[2];
            break;
        case 0:
            accidentals.fortyThree = symbols.fortyThree[3];
            break;
        case 1:
            accidentals.fortyThree = symbols.fortyThree[4];
            break;
        case 2:
            accidentals.fortyThree = symbols.fortyThree[5];
            break;
        case 3:
            accidentals.fortyThree = symbols.fortyThree[6];
            break;
    }
    // Prime 47
    switch (powers[14]) {
        case -3:
            accidentals.fortySeven = symbols.fortySeven[0];
            break;
        case -2:
            accidentals.fortySeven = symbols.fortySeven[1];
            break;
        case -1:
            accidentals.fortySeven = symbols.fortySeven[2];
            break;
        case 0:
            accidentals.fortySeven = symbols.fortySeven[3];
            break;
        case 1:
            accidentals.fortySeven = symbols.fortySeven[4];
            break;
        case 2:
            accidentals.fortySeven = symbols.fortySeven[5];
            break;
        case 3:
            accidentals.fortySeven = symbols.fortySeven[6];
            break;
    }
        
    // HEJI string

    const { natural, pythagorean, seven, eleven, thirteen, seventeen, nineteen, twentyThree,
        twentyNine, thirtyOne, thirtySeven, fortyOne, fortyThree, fortySeven } = accidentals;
    let hejiString = fortySeven + fortyThree + fortyOne + thirtySeven + thirtyOne + twentyNine +
        twentyThree + nineteen + seventeen + thirteen + eleven + seven + pythagorean + natural;
    if (fortySeven == "overflow" ||
        fortyThree == "overflow" ||
        fortyOne == "overflow" ||
        thirtySeven == "overflow" ||
        thirtyOne == "overflow" ||
        twentyNine == "overflow" ||
        twentyThree == "overflow" ||
        nineteen == "overflow" ||
        seventeen == "overflow" ||
        thirteen == "overflow" ||
        eleven == "overflow" ||
        seven == "overflow" ||
        pythagorean == "overflow" ||
        factors.remainder.num > 1 ||
        factors.remainder.den > 1) hejiString = "";
  
    return hejiString;
}

// Helper functions
function mod(x, y) {
	return ((x % y) + y) % y;
}

function getGCD(x, y) {
    if ((typeof x !== "number") || (typeof y !== "number")) 
        return false;
    x = Math.abs(x);
    y = Math.abs(y);
    while(y) {
        let t = y;
        y = x % y;
        x = t;
    }
    return x;
}

function multiplyRationals(rational1, rational2) {
    let num = rational1.fraction.num * rational2.fraction.num;
    let den = rational1.fraction.den * rational2.fraction.den;
    let gcd = getGCD(num, den);
    let fraction = new Fraction(num / gcd, den / gcd);
    return Rational.ViaFraction(fraction);
}

function divideRationals(rational1, rational2) {
    let num = rational1.fraction.num * rational2.fraction.den;
    let den = rational1.fraction.den * rational2.fraction.num;
    let gcd = getGCD(num, den);
    let fraction = new Fraction(num / gcd, den / gcd);
    return Rational.ViaFraction(fraction);
}

function getFifthsCount(powers) {
    let array = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    for (let i = 0; i < powers.length; i++) {
        array[i] = powers[i] * hsMap[i];
    }
    const fifthsCount = array.reduce(arrayReducer);
    return fifthsCount;
}

function frac(num, den) {
    return Rational.ViaFraction(new Fraction(num, den));
}

function storage(key) {
    return localStorage.getItem(key);
}

function store(key, value) {
    return localStorage.setItem(key, value);
}

function boolParse(string) {
    if (string == "true")
        return true;
    else if (string == "false")
        return false;
}

// UI functions

function openFragment(tabName, fragmentName) {
    $(".tab-content").css("display", "none");
    $(".tab-links").removeClass("active");

    $(`#${fragmentName}`).css("display", "block");
    $(`#${tabName}`).addClass("active");
}

function openModal(identifier) {
    document.querySelector(identifier).style.display = "flex";
}

function closeModal(identifier) {
    document.querySelector(identifier).style.display = "none";
}

function loadDefaultSettings() {
    // Settings
    $("#settings-precision").val(sessionSettings.precision);
    $(`.settings-octave-btn[value='${sessionSettings.octave}']`).click();
    $(`.settings-diatonic-btn[value='${sessionSettings.diatonic}']`).click();
    $(`.settings-chromatic-btn[value='${sessionSettings.chromatic}']`).click();
    $("#settings-unity-frequency").val(sessionSettings.unityFrequency);
    $(`input[name='settings-tuning-meter'][value='${sessionSettings.tuningMeterCents}']`).click();
    $("#settings-kammerton-frequency").val(sessionSettings.kammertonFrequency);
    $("#settings-normalise").prop("checked", sessionSettings.normalise);
    $(`input[name='settings-pb-midi-pitch'][value='${sessionSettings.midiReference}']`).click();
    $("#settings-sibelius-pb-range").val(sessionSettings.sibeliusRange);
    $("#settings-finale-pb-range").val(sessionSettings.finaleRange);
    // Reset select key value pairs (weren't "clicked")
    if (consent) {
        store("precision", sessionSettings.precision);
        store("unity_frequency", sessionSettings.unityFrequency);
        store("kammerton_frequency", sessionSettings.kammertonFrequency);
        store("normalise", sessionSettings.normalise);
        store("sibelius_range", sessionSettings.sibeliusRange);
        store("finale_range", sessionSettings.finaleRange);
    }
}

function loadNotationInput() {
    $(".octave-btn[value='9']").click();
    $(".diatonic-btn[value='4']").click();
    $(".pythagorean-btn[value='3']").click();
    $(".five-btn[value='3']").click();
    $(".seven-btn[value='3']").click();
    $(".eleven-btn[value='3']").click();
    $(".thirteen-btn[value='3']").click();
    $(".seventeen-btn[value='3']").click();
    $(".nineteen-btn[value='3']").click();
    $(".twentythree-btn[value='3']").click();
    $(".twentynine-btn[value='3']").click();
    $(".thirtyone-btn[value='3']").click();
    $(".thirtyseven-btn[value='3']").click();
    $(".fortyone-btn[value='3']").click();
    $(".fortythree-btn[value='3']").click();
    $(".fortyseven-btn[value='3']").click();
}

function loadRatioInput() {
    $("#offset-num").val(1);
    $("#offset-den").val(1);
    $("#input-num").val(1);
    $("#input-den").val(1);
}

function loadMelodicCheck() {
    $("#melodic-a-num").val(1);
    $("#melodic-a-den").val(1);
    $("#melodic-b-num").val(1);
    $("#melodic-b-den").val(1);
}

function calculate() {
    const unity = unityArray.reduce(rationalReducer)
    let input = paletteArray.reduce(rationalReducer);
    const inputRelative = divideRationals(input, unity);
    // Print num and den
    $(".numerator").html(inputRelative.fraction.num);
    $(".denominator").html(inputRelative.fraction.den);
    const hejiString = getAccidentals(inputRelative.factors)
    let diatonicNote = getDiatonicNote(input.factors.powers);
    if (inputMethod != "notation")
        diatonicNote = getDiatonicNote(inputRelative.factors.powers);
    $(".accidental-string").html(hejiString);
    $(".diatonic-note").html(diatonicNote);
    const sizeInCents = getCents(inputRelative.fraction.num, inputRelative.fraction.den);
}

//////////////////////////
// Execute on page load //
//////////////////////////

if (!consent)
    $("#consent-modal").removeClass("hidden");
$("#notation-tab").click(); 
loadDefaultSettings();
loadNotationInput();
loadRatioInput();
loadMelodicCheck();



