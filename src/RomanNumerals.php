<?php

namespace App;

use UnexpectedValueException;

class RomanNumerals
{
    /** @var array */
    const NUMERALS = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1,
    ];

    public static function generate(int $number): string
    {
        if ($number <= 0 || $number >= 4000) {
            throw new UnexpectedValueException();
        }

        $result = '';

        foreach (self::NUMERALS as $numeral => $arabic) {
            for (; $number >= $arabic; $number -= $arabic) {
                $result .= $numeral;
            }
        }

        return $result;
    }
}
