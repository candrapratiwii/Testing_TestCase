<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\TemperatureConverter;

class TemperatureCalculatorController extends Controller
{
    // Menampilkan halaman form kalkulator suhu
    public function index()
    {
        return view('temperature-calculator');
    }

    // Mengolah input dan menampilkan hasil konversi
    public function convert(Request $request)
    {
        // Validasi input
        $request->validate([
            'temperature' => 'required|numeric',
            'from' => 'required|in:celsius,fahrenheit,kelvin,rankine',
            'to' => 'required|in:celsius,fahrenheit,kelvin,rankine',
        ]);

        // Ambil input dari form
        $temperature = $request->input('temperature');
        $from = $request->input('from');
        $to = $request->input('to');

        // Panggil helper untuk konversi semua satuan
        $allConversions = TemperatureConverter::convertAllUnits($temperature, $from);

        // Ambil hasil konversi ke satuan tujuan
        $result = $allConversions[$to] ?? null;

        // Kirim semua data ke view
        return view('temperature-calculator', compact('temperature', 'from', 'to', 'result', 'allConversions'));
    }
}
