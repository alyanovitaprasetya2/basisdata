<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = ['pelangganID', 'TanggalPenjualan', 'TotalHarga', 'created_by', 'tempat_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelangganID');
    }
}
