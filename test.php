<?php

require_once('utils.php');
use General\Utils;


function runTests()
{
    echo "\n=== Testing getSecureRandom ===\n";
    testRandomNumberWithinRange();
    testRandomNumberIsUnique();
    testEdgeCaseSameMinMax();
    testInvalidRange();
    echo "=== All Tests Completed ===\n";
}

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
            echo "[FAIL]: Random number $randomNumber is not within the range [$min,$max]\n";
            return;
        }
    }
    echo "[PASS]: All numbers are within range\n";
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
    
    if (count($uniqueResults) < 10) {
        echo "[FAIL]: Random numbers are not unique enough\n";
    } else {
        echo "[PASS]: Random numbers appear sufficiently unique\n";
    }

  }

  /**
   * let's test if the function can handle edge cases
   */

   function testEdgeCaseSameMinMax()
{
    $min = 5;
    $max = 5;
    echo "Test 3: Handle edge case (min == max)\n";

    for ($i = 0; $i < 10; $i++) {
        
        $randomNumber = Utils::getSecureRandom($min, $max);

        if ($randomNumber !== $min) { 
            echo "[FAIL]: Expected $min, got $randomNumber\n";
            return;
        }
    }
    echo "[PASS]: Edge case handled correctly\n";
}

/**
 * let's test if the min > max
 */

 function testInvalidRange() 
 {
    $min = 20;
    $max = 10;
    echo "Test 4: Invalid range (min > max)\n";

    try {
        Utils::getSecureRandom($min, $max);
        echo "[FAIL]: Function did not handle invalid input (min > max)\n";
    } catch (Exception $e) {
        echo "[PASS]: Function threw exception for invalid range\n";
    }
 }
runTests();
?>