<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka, $withPrefix = true)
    {
        $formatted = number_format($angka, 0, ',', '.');
        return $withPrefix ? 'Rp' . $formatted : $formatted;
    }
}

function accessTypes() : array {
    return [
        1 => "Administrator",
        2 => "Pegawai",
    ];
}

function paymentMethod () : array {
    return [
        1 => "TUNAI",
        2 => "QRIS",
        3 => "TRANSFER"
    ];
}

if (!function_exists('formatTanggal')) {
    /**
     * Format tanggal ke dalam bahasa Indonesia (tanpa hari)
     *
     * @param string $tanggal Tanggal dalam format Y-m-d atau Y-m-d H:i:s
     * @return string Tanggal yang diformat dalam bahasa Indonesia
     */
    function formatTanggal($tanggal)
    {
        // Nama-nama bulan dalam bahasa Indonesia
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        // Pastikan tanggal dalam format yang valid
        $timestamp = strtotime($tanggal);
        if (!$timestamp) {
            return 'Tanggal tidak valid';
        }

        $hari = date('d', $timestamp);
        $bulanIndex = date('n', $timestamp);
        $tahun = date('Y', $timestamp);

        return "{$hari} {$bulan[$bulanIndex]} {$tahun}";
    }
}

function formatedDate($dateString, $withDay = true)
{
    // Konversi string tanggal ke timestamp
    $timestamp = strtotime($dateString);

    // Array untuk nama hari dalam bahasa Indonesia
    $days = [
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    ];

    // Array untuk nama bulan dalam bahasa Indonesia
    $months = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    // Mendapatkan nama hari
    $dayName = $days[date('w', $timestamp)];

    // Mendapatkan hari, bulan, dan tahun
    $day = date('d', $timestamp);
    $monthName = $months[date('n', $timestamp)];
    $year = date('Y', $timestamp);

    // Menggabungkan semuanya menjadi format yang diinginkan
    if ($withDay) {
        return "{$dayName}, {$day} {$monthName} {$year}";
    }
    return "{$day} {$monthName} {$year}";
}


function accessType(int $id) : string {
    return accessTypes()[$id];
}

function getUserAccessType($id)
{
    $data = accessTypes();

    if (array_key_exists($id, $data)) {
        return $data[$id];
    } else {
        return null; 
    }
}

function tempatID(): int
{
    return (int) session("tempat_id");
}

function userID(): int
{
    return Auth::user()->id;
}