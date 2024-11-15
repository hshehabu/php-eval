<?php

require_once('utils.php');
use General\Utils;

/**
 * let's verify the numbers are in range
 * 
 */

 function testRandomNumberWithinRange()
 {
    $min = 10;
    $max = 17;

    echo "Test 1: Numbers within range [$min,$max]\n";

    for ($i = 0 ; $i < 10 ; $i++){
        $randomNumber = Utils::getSecureRandom($min, $max);
        if($randomNumber < $min || $randomNumber > $max){
            echo "Test 1 failed: Random number $randomNumber is not within the range [$min,$max]\n";
            return;
        }
    }
    echo "Test 1 passed: All numbers are within range\n";
 }

 /**
  * let's test that the function returns different numbers over multiple calls.
  */

   function testRandomNumberIsUnique() 
  {
    $min = 1;
    $max = 20;

    echo "Test 2: Check randomness\n";

    $results = [];

    for($i = 0; $i < 20 ; $i++){
        $results[] = Utils::getSecureRandom($min , $max);
    }

    $uniqueResults = array_unique($results);
    echo count($uniqueResults);
    if (count($uniqueResults) < 10) {
        echo "FAIL: Random numbers are not unique enough\n";
    } else {
        echo "PASS: Random numbers appear sufficiently unique\n";
    }

  }

?>