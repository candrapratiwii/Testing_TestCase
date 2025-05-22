<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TemperatureCalculatorTest extends TestCase
{
    /** @test */
    public function halaman_utama_mengarah_ke_kalkulator_suhu()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('Kalkulator Konversi Suhu'); // Sesuaikan dengan judul pada halaman
    }

    /** @test */
    public function dapat_mengonversi_dari_celsius_ke_fahrenheit()
    {
        $response = $this->post('/temperature-calculator', [
            'temperature' => 100,
            'from' => 'celsius',
            'to' => 'fahrenheit',
        ]);

        $response->assertStatus(200);
        $response->assertSeeText('212'); // 100°C = 212°F
    }

    /** @test */
    public function dapat_mengonversi_dari_fahrenheit_ke_celsius()
    {
        $response = $this->post('/temperature-calculator', [
            'temperature' => 32,
            'from' => 'fahrenheit',
            'to' => 'celsius',
        ]);

        $response->assertStatus(200);
        $response->assertSeeText('0'); // 32°F = 0°C
    }

    /** @test */
    public function konversi_dengan_input_kosong_menghasilkan_error()
    {
        $response = $this->post('/temperature-calculator', [
            'temperature' => null,
            'from' => '',
            'to' => '',
        ]);

        $response->assertStatus(302); // Redirect karena validasi gagal
        $response->assertSessionHasErrors(['temperature', 'from', 'to']);
    }
}
