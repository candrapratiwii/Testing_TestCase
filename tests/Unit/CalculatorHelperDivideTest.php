<?php

namespace Tests\Unit;

use App\Helpers\CalculatorHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CalculatorHelperDivideTest extends TestCase
{
    public function testDivide()
    {
        $this->assertEquals(2, CalculatorHelper::divide(4, 2));
    }

    public function testMultipleDivide()
    {
        $cases = [
            [10, 2, 5],
            [9, 3, 3],
            [8, 4, 2],
        ];

        foreach ($cases as [$a, $b, $expected]) {
            $this->assertEquals($expected, CalculatorHelper::divide($a, $b));
        }
    }

    #[DataProvider('divideProvider')]
    public function testDivideWithDataProvider($a, $b, $expected)
    {
        $this->assertEquals($expected, CalculatorHelper::divide($a, $b));
    }

    public static function divideProvider()
    {
        return [
            [20, 4, 5],
            [15, 5, 3],
            [18, 6, 3],
            [0, 1, 0],
        ];
    }

    public function testDivideByZero()
    {
        $this->expectException(\DivisionByZeroError::class);
        CalculatorHelper::divide(10, 0);
    }
}
