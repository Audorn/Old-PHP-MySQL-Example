<?php
/** 
 * Roman numeral translation file.
 * PHP version 7.2
 * 
 * @category LanguageConversion
 * @package  RomanNumerals
 * @author   J Anderson <email@gmail.com>
 * @license  http://www.gnu.org/copyleft/notaliscence.html Fake Public License
 * @link     http://www.notareallink.com
 */


 /** 
  * Translates a 0-based number into a Roman numeral. (Limit 3,000)
  * 
  * @param int $number 0-based number.
  * 
  * @return The corresponding Roman numeral.
  */
function toRoman($number) 
{
    // Rules:   I = 1
    //          V = 5
    //          X = 10
    //          L = 50
    //          C = 100
    //          D = 500
    //          M = 1000

    $numberAsString = "$number";
    $digits = strlen($numberAsString);

    $romanNumerals = '';
    for ($i = 0; $i < $digits; $i++) {
        $trailingZeros = ($digits - 1) - $i;
        $romanNumerals .= translateDigit(
            $numberAsString[$i], getSymbols($trailingZeros)
        );
    }

    return $romanNumerals;
}

function translateDigit($singleDigit, $romanChars) 
{
    $romanNumerals = '';
    if ($singleDigit < 4) {
        $romanNumerals .= str_repeat($romanChars[0], $singleDigit); // I-III
    } else if ($singleDigit == 4) {
        $romanNumerals .= $romanChars[0] . $romanChars[1];          // IV
    } else if ($singleDigit == 5) {
        $romanNumerals .= $romanChars[1];                           // V
    } else if ($singleDigit > 5 && $singleDigit < 9) {
        $romanNumerals .= $romanChars[1];
        $repeat = $singleDigit - 5;
        $romanNumerals .= str_repeat($romanChars[0], $repeat);      // VIII
    } else {
        $romanNumerals .= $romanChars[0] . $romanChars[2];          // IX
    }

    return $romanNumerals;
}

function getSymbols($trailingZeros) 
{
    if ($trailingZeros == 0) return ['I', 'V', 'X'];
    if ($trailingZeros == 1) return ['X', 'L', 'C'];
    if ($trailingZeros == 2) return ['C', 'D', 'M'];
    if ($trailingZeros == 3) return ['M', ' ', ' '];
}
