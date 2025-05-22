<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\Helpers\TemperatureConverter;

class TemperatureConverterTest extends TestCase
{
    #[Test]
    public function konversi_dari_celsius_ke_semua_satuan()
    {
        $result = TemperatureConverter::convertAllUnits(0, 'celsius');

        $this->assertEquals(0, $result['celsius']);
        $this->assertEquals(32, $result['fahrenheit']);
        $this->assertEquals(273.15, $result['kelvin']);
        $this->assertEquals(491.67, $result['rankine']);
    }

    #[Test]
    public function konversi_dari_kelvin_ke_celsius()
    {
        $result = TemperatureConverter::convertAllUnits(273.15, 'kelvin');

        $this->assertEquals(0, $result['celsius']);
    }

    #[Test]
    public function konversi_dari_rankine_ke_celsius()
    {
        $result = TemperatureConverter::convertAllUnits(491.67, 'rankine');

        $this->assertEquals(0, $result['celsius']);
    }

    #[Test]
    public function konversi_dengan_unit_tidak_valid()
    {
        $result = TemperatureConverter::convertAllUnits(100, 'invalid');

        $this->assertEquals(0, $result['celsius']);
    }
}
