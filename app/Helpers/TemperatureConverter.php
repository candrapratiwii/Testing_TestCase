<?php

namespace App\Helpers;

class TemperatureConverter
{
    public static function convertAllUnits($temp, $from)
    {
        // Ubah ke Celsius terlebih dahulu
        switch ($from) {
            case 'celsius':
                $celsius = $temp;
                break;
            case 'fahrenheit':
                $celsius = ($temp - 32) * 5 / 9;
                break;
            case 'kelvin':
                $celsius = $temp - 273.15;
                break;
            case 'rankine':
                $celsius = ($temp - 491.67) * 5 / 9;
                break;
            default:
                $celsius = 0;
                break;
        }

        // Hitung konversi ke semua satuan
        return [
            'celsius'    => round($celsius, 2),
            'fahrenheit' => round(($celsius * 9 / 5) + 32, 2),
            'kelvin'     => round($celsius + 273.15, 2),
            'rankine'    => round(($celsius + 273.15) * 9 / 5, 2),
        ];
    }
}
