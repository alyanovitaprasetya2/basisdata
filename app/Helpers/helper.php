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