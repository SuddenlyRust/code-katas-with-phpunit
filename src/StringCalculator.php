<?php

namespace App;

use InvalidArgumentException;

class StringCalculator
{
    /** @var int */
    const MAX_NUMBER_ALLOWED = 1000;

    public function add(string $numbers): int
    {
        if (! $numbers) {
            return 0;
        }

        $numbers = $this->parseString($numbers);

        $this->disallowNegatives($numbers);

        return array_sum(
            $this->ignoreGreaterThan1000($numbers)
        );
    }

    protected function parseString(string $numbers): array
    {
        $delimiter = ",|\n";

        $customDelimiter = "\/\/(.)\n";

        if (preg_match("/{$customDelimiter}/", $numbers, $matches)) {
            $delimiter = $matches[1];

            $numbers = str_replace($matches[0], '', $numbers);
        }

        return preg_split("/{$delimiter}/", $numbers);
    }

    protected function disallowNegatives(array $numbers): void
    {
        foreach ($numbers as $number) {
            if ($number < 0) {
                throw new InvalidArgumentException(
                    'Negative numbers are disallowed!'
                );
            }
        }
    }

    protected function ignoreGreaterThan1000(array $numbers): array
    {
        return array_filter(
            $numbers, fn(int $number) => $number <= self::MAX_NUMBER_ALLOWED,
        );
    }
}
