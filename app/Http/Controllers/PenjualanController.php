<?php

namespace App\Http\Controllers;

use App\Entities\UserEntity;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {   
        $produk = Produk::where('tempat_id', tempatID())->get();
        return view('pages.penjualan.index', [
            "produk" => $produk
        ]);
    }

    public function store(Request $req)
    {
        if (!$req->totalHarga || $req->totalHarga == 0) {
            return redirect()->back()->with('error', 'Pilih Menu Dahulu');
        }

        $penjualan = Penjualan::create([
            "pelangganID"      => null,
            "TanggalPenjualan" => Carbon::now(),
            "TotalHarga"       => $req->totalHarga,
            "created_by"       => userID(),
            "tempat_id"        => tempatID()
        ]);

        $pesananJson = $req->input('pesanan');
        $pesananArray = json_decode($pesananJson, true);

        foreach ($pesananArray as $item) {
            DetailPenjualan::create([
                'penjualanID' => $penjualan->id,
                'produkID' => $item['produkID'],
                'JumlahProduk' => $item['jumlah'],
                'Subtotal' => $item['jumlah'] * $item['harga'],
                'Tanggal' => Carbon::now(),
                'tempat_id' => tempatID(),
                'created_by' => userID()
            ]);
        }


        if($penjualan) {
            return redirect()->back()->with('success', 'Berhasil Membuat Pesanan');
        } else {
            return redirect()->back()->with('error', 'Gagal Membuat Pesanan');
        }
    }

    public function rekapPenjualan()
    {
        $data = Penjualan::query();

        if(Auth::user()->role === UserEntity::ADMINISTRATOR) {
            $data = $data->where('tempat_id', tempatID());
        } else {
            $data = $data->where('tempat_id', tempatID())
                        ->where('pelangganID', userID());
        }

        $data = $data->get();

        return view('pages.rekap_penjualan.list', compact('data'));
    }
}
