<?php

/**
 * API Endpoint to generate a secure random number
 * 
 * This script serves as an API that uses the Utils::getSecureRandom function 
 * to generate a secure random integer between a given range. The API accepts
 * `min` and `max` as query parameters and returns a JSON response.
 */

require_once 'utils.php';
use General\Utils;

header('Content-Type: application/json');

$min = isset($_GET['min']) ? intval($_GET['min']) : null;
$max = isset($_GET['max']) ? intval($_GET['max']) : null;

/**
 * Validates the input parameters for the random number generator.
 *
 * @param int|null $min Minimum value for the range
 * @param int|null $max Maximum value for the range
 * @throws Exception if validation fails
 * @return bool Returns true if validation passes
 */
function validate($min, $max) {
    if ($min === null || $max === null) {
        throw new \Exception('Both min and max parameters are required.');
    }
    if (!is_int($min) || !is_int($max)) {
        throw new Exception('"min" and "max" must be integers.');
    }
    if ($min > $max) {
        throw new \Exception('Min value cannot be greater than max value.');
    }

    return true;
}

try {

    validate($min, $max);

    $randomNumber = Utils::getSecureRandom($min, $max);

    echo json_encode([
        'status' => 'success',
        'data' => [
            'random_number' => $randomNumber,
            'min' => $min,
            'max' => $max
        ]
    ]);
} catch (\Throwable $th) {
    
    echo json_encode([
        'status' => 'error',
        'message' => $th->getMessage()
    ]);
}
