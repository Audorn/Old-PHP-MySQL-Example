<?php

/**
 * Find all prime numbers up to and including the upperLimit.
 * 
 * @param int $upperLimit 
 * 
 * @return array All prime numbers, or empty.
 */
function sieve($upperLimit)
{
    if ($upperLimit < 2)
        return [];
        
    $numbers = range(2, $upperLimit);
    foreach ($numbers as $prime) {
        unsetMultiplesOf($prime, $numbers);
    }

    return array_values($numbers);
}

/**
 * Unset all multiples of the prime number from the array of numbers.
 * 
 * @param int   $prime 
 * @param array $numbers Reference to an array of numbers.
 * 
 * @return void
 */
function unsetMultiplesOf($prime, &$numbers)
{
    foreach ($numbers as $key => $number) {
        if ($number % $prime == 0 && $number != $prime)
            unset($numbers[$key]);
    }
}