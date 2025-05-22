<?php

namespace App\Helpers;

class CalculatorHelper
{
    public static function add($a, $b)
    {
        return $a + $b;
    }

    public static function subtract($a, $b)
    {
        return $a - $b;
    }

    public static function perkalian($a, $b)
    {
        return $a * $b;
    }

    public static function divide($a, $b)
    {
        if ($b == 0) {
            throw new \DivisionByZeroError("Pembagi tidak boleh nol.");
        }
        return $a / $b;
    }
}
