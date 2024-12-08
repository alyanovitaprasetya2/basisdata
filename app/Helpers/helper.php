<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka, $withPrefix = true)
    {
        $formatted = number_format($angka, 0, ',', '.');
        return $withPrefix ? 'Rp' . $formatted : $formatted;
    }
}

if (!function_exists('formatRp')) {
    /**
     * Format angka menjadi format rupiah tanpa "Rp".
     *
     * @param int|float $number
     * @return string
     */
    function formatRp($number)
    {
        return number_format($number, 0, ',', '.');
    }
}

function accessTypesa() : array {
    return [
        1 => "Administrator",
        2 => "Pegawai",
    ];
}

function accessTypes($access)
{
    switch ($access) {
        case 1:
            return 'Administrator';
        case 2:
            return 'Pegawai';
        case 3:
            return 'Super Admin';
        case 4:
            return 'Pengawas';
        default:
            return 'UNKNOWN';
    }
}

function statusMeja($access)
{
    switch ($access) {
        case 1:
            return 'Kosong';
        case 2:
            return 'Dipakai';
        case 3:
            return 'Diperbaiki';
        default:
            return 'UNKNOWN';
    }
}

if (!function_exists('generateCode')) {
    /**
     * Generate a unique code with a fixed prefix and length.
     *
     * @return string
     */
    function generateCode()
    {
        $prefix = 'SKB'; // Prefix tetap
        $length = 10; // Total panjang kode (termasuk prefix)

        // Panjang angka yang dihasilkan (tanpa prefix)
        $numberLength = $length - strlen($prefix);

        // Pastikan panjang minimum masuk akal
        if ($numberLength < 1) {
            throw new InvalidArgumentException('Panjang kode harus lebih besar dari panjang prefix.');
        }

        // Generate angka random
        $randomNumber = substr(str_shuffle(str_repeat('0123456789', $numberLength)), 0, $numberLength);

        // Gabungkan prefix dengan angka random
        return strtoupper($prefix) . $randomNumber;
    }
}

function getPaymentMethod($metBay)
{
    switch ($metBay) {
        case 1:
            return 'TUNAI';
        case 2:
            return 'QRIS';
        case 3:
            return 'TRANSFER';
        default:
            return 'UNKNOWN';
    }
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

function tempatID(): int
{
    return (int) session("tempat_id");
}

function userID(): int
{
    return Auth::user()->id;
}