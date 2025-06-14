import { Rational, Fraction } from "./rational.js";
    
export function frac(num, den) {
    return Rational.ViaFraction(new Fraction(num, den));
}

export const octave = [
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

export const diatonic = [
    frac(64, 81),
    frac(16, 27),
    frac(8, 9),
    frac(2, 3),
    frac(1, 1),
    frac(3, 2),
    frac(9, 8)
];

export const chromatic = [
    frac(8589934592, 10460353203),
    frac(4194304, 4782969),
    frac(2048, 2187),
    frac(1, 1),
    frac(2187, 2048),
    frac(4782969, 4194304),
    frac(10460353203, 8589934592)
];

export const prime5 = [
    frac(512000, 531441),
    frac(6400, 6561),
    frac(80, 81),
    frac(1, 1),
    frac(81, 80),
    frac(6561, 6400),
    frac(531441, 512000)
];

export const prime7 = [
    frac(250047, 262144),
    frac(3969, 4096),
    frac(63, 64),
    frac(1, 1),
    frac(64, 63),
    frac(4096, 3969),
    frac(262144, 250047)
];

export const prime11 = [
    frac(32768, 35937),
    frac(1024, 1089),
    frac(32, 33),
    frac(1, 1),
    frac(33, 32),
    frac(1089, 1024),
    frac(35937, 32768)
];

export const prime13 = [
    frac(17576, 19683),
    frac(676, 729),
    frac(26, 27),
    frac(1, 1),
    frac(27, 26),
    frac(729, 676),
    frac(19683, 17576)
];

export const prime17 = [
    frac(10303307776, 10460353203),
    frac(4734976, 4782969),
    frac(2176, 2187),
    frac(1, 1),
    frac(2187, 2176),
    frac(4782969, 4734976),
    frac(10460353203, 10303307776)
];

export const prime19 = [
    frac(134217728, 135005697),
    frac(262144, 263169),
    frac(512, 513),
    frac(1, 1),
    frac(513, 512),
    frac(263169, 262144),
    frac(135005697, 134217728)
];

export const prime23 = [
    frac(387420489, 398688256),
    frac(531441, 541696),
    frac(729, 736),
    frac(1, 1),
    frac(736, 729),
    frac(541696, 531441),
    frac(398688256, 387420489)
];

export const prime29 = [
    frac(16777216, 17779581),
    frac(65536, 68121),
    frac(256, 261),
    frac(1, 1),
    frac(261, 256),
    frac(68121, 65536),
    frac(17779581, 16777216)
];

export const prime31 = [
    frac(29791, 32768),
    frac(961, 1024),
    frac(31, 32),
    frac(1, 1),
    frac(32, 31),
    frac(1024, 961),
    frac(32768, 29791)
];

export const prime37 = [
    frac(46656, 50653),
    frac(1296, 1369),
    frac(36, 37),
    frac(1, 1),
    frac(37, 36),
    frac(1369, 1296),
    frac(50653, 46656)
];

export const prime41 = [
    frac(531441, 551368),
    frac(6561, 6724),
    frac(81, 82),
    frac(1, 1),
    frac(82, 81),
    frac(6724, 6561),
    frac(551368, 531441)
];

export const prime43 = [
    frac(2097152, 2146689),
    frac(16384, 16641),
    frac(128, 129),
    frac(1, 1),
    frac(129, 128),
    frac(16641, 16384),
    frac(2146689, 2097152)
];

export const prime47 = [
    frac(387420489, 425259008),
    frac(531441, 565504),
    frac(729, 752),
    frac(1, 1),
    frac(752, 729),
    frac(565504, 531441),
    frac(425259008, 387420489)
];

export const diatonicSymbols = ["F", "C", "G", "D", "A", "E", "B"];