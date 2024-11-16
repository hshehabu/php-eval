<?php

namespace General;

class Utils {
    /**
     * Returns random integer between given range
     *
     * @param int $min
     * @param int $max
     * @return void
     */
    static function getSecureRandom($min, $max) {

		if($min > $max){
   			throw new \Exception('Invalid range: min should be less than max');
		}

		$range = $max - $min;
		$range_log = log($range, 2);
		$bytes_to_fetch = (int) ($range_log / 8) + 1;
		//possibly not as large as bytes to fetch (eg only care about 6 bits in 1 byte)
		$bits_to_fetch = (int) $range_log + 1;
		//rng filter to assist in requiring less loops to generate random numbers
		//the filter doesn't constrain random numbers to our exact range, but it does
		//get them closer.	eg Only care about 6 bits and generate random data for one byte
		//we discard the 2 highest bits and then see if that result is still greater than our range
		//filter in bin has all bits set to 1 of length $bits_to_fetch 
		$rng_filter = (int) (1 << $bits_to_fetch) - 1;
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes_to_fetch)));
			 // discard irrelevant bits
			$rnd = $rnd & $rng_filter;
		} while ($rnd > $range);
		return $min + $rnd;
	}
}

?>