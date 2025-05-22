<!DOCTYPE html>
<html>

<head>
    <title>Kalkulator Konversi Suhu</title>
</head>

<body>
    <h1>Kalkulator Konversi Suhu</h1>

    <form method="POST" action="/temperature-calculator">
        @csrf

        <!-- Input Suhu -->
        <input type="number" name="temperature" step="0.1" placeholder="Masukkan suhu"
            value="{{ old('temperature', $temperature ?? '') }}" required>

        <!-- Pilih Satuan Asal -->
        <select name="from" required>
            <option value="">Dari</option>
            <option value="celsius" {{ old('from', $from ?? '') == 'celsius' ? 'selected' : '' }}>Celsius (°C)</option>
            <option value="fahrenheit" {{ old('from', $from ?? '') == 'fahrenheit' ? 'selected' : '' }}>Fahrenheit (°F)</option>
            <option value="kelvin" {{ old('from', $from ?? '') == 'kelvin' ? 'selected' : '' }}>Kelvin (K)</option>
            <option value="rankine" {{ old('from', $from ?? '') == 'rankine' ? 'selected' : '' }}>Rankine (°R)</option>
        </select>

        <!-- Pilih Satuan Tujuan -->
        <select name="to" required>
            <option value="">Ke</option>
            <option value="celsius" {{ old('to', $to ?? '') == 'celsius' ? 'selected' : '' }}>Celsius (°C)</option>
            <option value="fahrenheit" {{ old('to', $to ?? '') == 'fahrenheit' ? 'selected' : '' }}>Fahrenheit (°F)</option>
            <option value="kelvin" {{ old('to', $to ?? '') == 'kelvin' ? 'selected' : '' }}>Kelvin (K)</option>
            <option value="rankine" {{ old('to', $to ?? '') == 'rankine' ? 'selected' : '' }}>Rankine (°R)</option>
        </select>

        <button type="submit">Konversi</button>
    </form>

    <!-- Hasil Konversi -->
    @if (isset($result))
        <h2>Hasil:</h2>
        <p><strong>{{ $temperature }}° {{ ucfirst($from) }}</strong> = <strong>{{ $result }}° {{ ucfirst($to) }}</strong></p>

        <h3>Konversi ke Semua Satuan:</h3>
        <ul>
            @foreach($allConversions as $unit => $value)
                <li>{{ ucfirst($unit) }}: {{ $value }}°</li>
            @endforeach
        </ul>
    @endif

    <!-- Validasi Error -->
    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    @endif
</body>

</html>
