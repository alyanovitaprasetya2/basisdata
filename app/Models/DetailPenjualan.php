<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $table = "detail_penjualan";

    protected $fillable = [
        'penjualanID', 'produkID', 'JumlahProduk', 'Subtotal', 'Tanggal', 'tempat_id', 'created_by'
    ];

    public $timestamps = false;

    public function penjualan(){
        return $this->belongsTo(Penjualan::class, 'penjualanID', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function produk(){
        return $this->belongsTo(Produk::class, 'produkID', 'id');
    }
}
