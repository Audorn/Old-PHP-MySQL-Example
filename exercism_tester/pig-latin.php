<?php 

function translate($text)
{
    $vowels = ['a', 'e', 'i', 'o', 'u'];
    $doubleVowels = ['xr', 'yt'];
    $doubleConsonants = ['ch', 'qu', 'th'];
    $tripleConsonants = ['thr', 'sch', 'squ'];
    $suffix = "ay";

    $translatedText = '';
    foreach (explode(' ', $text) as $word) {
        $firstLetter = substr($word, 0, 1);
        $firstTwoLetters = substr($word, 0, 2);
        $firstThreeLetters = substr($word, 0, 3);
    
        if (in_array($firstLetter, $vowels) 
         || in_array($firstTwoLetters, $doubleVowels)) {
            $translatedText .= ' ' . $word . $suffix;
        } else if (in_array($firstThreeLetters, $tripleConsonants)) {
            $translatedText .= ' ' . substr($word, 3) 
                                   . $firstThreeLetters . $suffix;
        } else if (in_array($firstTwoLetters, $doubleConsonants)) {
            $translatedText .= ' ' . substr($word, 2) 
                                   . $firstTwoLetters . $suffix;
        } else {
            $translatedText .= ' ' . substr($word, 1) 
                                   . $firstLetter . $suffix;
        }
    }

    return substr($translatedText, 1); 
}