<?php

namespace App;

/** @see \FizzBuzzTest */
class FizzBuzz
{
    /**
     * @return string|int
     */
    public static function convert(int $number)
    {
        $result = '';

        if ($number % 3 === 0) {
            $result .= 'fizz';
        }

        if ($number % 5 === 0) {
            $result .= 'buzz';
        }

        return $result ?: $number;
    }
}
