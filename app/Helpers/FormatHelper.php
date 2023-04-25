<?php

namespace App\Helpers;

use Carbon\Carbon;

class FormatHelper
{
    public static function tanggal(string|Carbon $tanggal)
    {
        if (is_string($tanggal)) {
            return Carbon::parse($tanggal)->format('d F Y');
        }

        return $tanggal->format('d F Y');
    }

    public static function angka($angka)
    {
        return number_format(is_null($angka) ? 0 : $angka, 2, ',', '.');
    }

    public static function angkaKeRoman(int $num): string
    {
        // Be sure to convert the given parameter into an integer

        $result = '';

        // Declare a lookup array that we will use to traverse the number:
        $lookup = [
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1,
        ];

        foreach ($lookup as $roman => $value) {
            // Look for number of matches
            $matches = intval($num / $value);

            // Concatenate characters
            $result .= str_repeat($roman, $matches);

            // Substract that from the number
            $num = $num % $value;
        }

        return $result;
    }
}
