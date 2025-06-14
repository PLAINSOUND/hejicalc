import { sessionSettings, reducer } from "./main.js";
import { diatonicSymbols } from "./hejiPalette.js";

export const primes = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47];
const hsMap = [0, 1, 4, -2, -1, 3, 7, -3, 6, -2, 0, 2, 4, -1, 6];

// Classes for Factors, Fraction, and Rational
// -------------------------------------------

export class Factors { // e.g. Notation input via palette
    constructor(powers, remainderNum, remainderDen) {
        this.powers = powers;
        this.remainder = {
            num: remainderNum,
            den: remainderDen
        };
    }
}

export class Fraction { // e.g. Ratio input
    constructor(num, den) {
        this.num = num;
        this.den = den;
    }
}

export class Unity {
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

export class Rational extends Unity {
    constructor(factors, fraction) {
        super(factors);
        this.fraction = fraction;
        this.sizeInCents = getCents(fraction.num, fraction.den);
        this.diatonicNote = getDiatonicNote(factors.powers);
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

// Functions for working with rationals 
// ------------------------------------

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

export function multiplyRationals(rational1, rational2) {
    let num = rational1.fraction.num * rational2.fraction.num;
    let den = rational1.fraction.den * rational2.fraction.den;
    let gcd = getGCD(num, den);
    let fraction = new Fraction(num / gcd, den / gcd);
    return Rational.ViaFraction(fraction);
}

export function divideRationals(rational1, rational2) {
    let num = rational1.fraction.num * rational2.fraction.den;
    let den = rational1.fraction.den * rational2.fraction.num;
    let gcd = getGCD(num, den);
    let fraction = new Fraction(num / gcd, den / gcd);
    return Rational.ViaFraction(fraction);
}

function getCents(num, den) {
    return (1200 * Math.log2(num / den)).toFixed(sessionSettings.precision);
}

function getFifthsCount(powers) {
    let array;
    for (let i = 0; i < powers.length; i++) {
        array.push(powers[i] * hsMap[i]);
    }
    const fifthsCount = array.reduce(reducer);
    return fifthsCount;
}

function getDiatonicNote(powers) {
    const fifthsCount = getFifthsCount(powers);
    const diatonicNote = diatonicSymbols[fifthsCount];
    return diatonicNote;
}