import {
    consent, defaultSettings, sessionSettings, storage,
    store, paletteArray, calculate, unityArray
} from "./main.js";
import {
    octave, diatonic, chromatic, prime5, prime7,
    prime11, prime13, prime17, prime19, prime23,
    prime29, prime31, prime37, prime41, prime43, prime47
} from "./hejiPalette.js";

export let inputMethod = "notation";

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
});

$(".diatonic-btn").on("click", function() {
    $(".diatonic-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[1] = diatonic[$(this).val()];
    inputMethod = "notation";
});

$(".pythagorean-btn").on("click", function() {
    $(".pythagorean-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[2] = chromatic[$(this).val()];
    inputMethod = "notation";
});

$(".five-btn").on("click", function() {
    $(".five-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[3] = prime5[$(this).val()];
    inputMethod = "notation";
});

$(".seven-btn").on("click", function() {
    $(".seven-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[4] = prime7[$(this).val()];
    inputMethod = "notation";
});

$(".eleven-btn").on("click", function() {
    $(".eleven-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[5] = prime11[$(this).val()];
    inputMethod = "notation";
});

$(".thirteen-btn").on("click", function() {
    $(".thirteen-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[6] = prime13[$(this).val()];
    inputMethod = "notation";
});

$(".seventeen-btn").on("click", function() {
    $(".seventeen-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[7] = prime17[$(this).val()];
    inputMethod = "notation";
});

$(".nineteen-btn").on("click", function() {
    $(".nineteen-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[8] = prime19[$(this).val()];
    inputMethod = "notation";
});

$(".twentythree-btn").on("click", function() {
    $(".twentythree-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[9] = prime23[$(this).val()];
    inputMethod = "notation";
});

$(".twentynine-btn").on("click", function() {
    $(".twentynine-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[10] = prime29[$(this).val()];
    inputMethod = "notation";
});

$(".thirtyone-btn").on("click", function() {
    $(".thirtyone-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[11] = prime31[$(this).val()];
    inputMethod = "notation";
});

$(".thirtyseven-btn").on("click", function() {
    $(".thirtyseven-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[12] = prime37[$(this).val()];
    inputMethod = "notation";
});

$(".fortyone-btn").on("click", function() {
    $(".fortyone-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[13] = prime41[$(this).val()];
    inputMethod = "notation";
});

$(".fortythree-btn").on("click", function() {
    $(".fortythree-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[14] = prime43[$(this).val()];
    inputMethod = "notation";
});

$(".fortyseven-btn").on("click", function() {
    $(".fortyseven-btn").removeClass("selected");
    $(this).addClass("selected");
    paletteArray[15] = prime47[$(this).val()];
    inputMethod = "notation";
});

$("#notation-reset").on("click", function() {
    loadNotationInput();
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

// Execute on page load
$("#notation-tab").click(); 
loadDefaultSettings();
loadNotationInput();
loadRatioInput();
loadMelodicCheck();