<?php

namespace App\Http\Controllers;

use App\Entities\UserEntity;
use App\Models\DetailPenjualan;
use App\Models\Meja;
use App\Models\Penjualan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {   
        $produk = Produk::where('tempat_id', tempatID())->get();
        $meja = Meja::where('tempat_id', tempatID())
                    ->where('is_active', 1)
                    ->get();

        return view('pages.penjualan.index', [
            "produk" => $produk,
            "meja" => $meja,
        ]);
    }

    public function store(Request $req)
    {
        if (!$req->totalHarga || $req->totalHarga == 0) {
            return redirect()->back()->with('error', 'Pilih Menu Dahulu');
        }

        $req->validate([
            'meja' => 'nullable|exists:meja,id',
        ]);

        $penjualan = Penjualan::create([
            "pelangganID"      => null,
            "TanggalPenjualan" => Carbon::now(),
            "TotalHarga"       => $req->totalHarga,
            "created_by"       => userID(),
            "Kode"             => generateCode(),
            "tempat_id"        => tempatID(),
            "Metode"           => $req->metode,
            "Kembali"          => $req->kembalian,
            "Dibayar"          => $req->bayar_raw,
            "meja_id"          => $req->meja
        ]);

        $pesananJson = $req->input('pesanan');
        $pesananArray = json_decode($pesananJson, true);

        foreach ($pesananArray as $item) {
           DetailPenjualan::create([
                'penjualanID'  => $penjualan->id,
                'produkID'     => $item['produkID'],
                'JumlahProduk' => $item['jumlah'],
                'Subtotal'     => $item['jumlah'] * $item['harga'],
                'Tanggal'      => Carbon::now(),
                'tempat_id'    => tempatID(),
                'created_by'   => userID(),
            ]);

            $produk = Produk::find($item['produkID']);
            if($produk){
                $produk->Stok -= $item['jumlah'];
                if ($produk->stok < 0) {
                    DB::rollBack();
                    session()->flash('error', 'Stok produk tidak mencukupi');
                    return redirect()->back();
                }
                $produk->save();
            } else {
                DB::rollBack();
                session()->flash('error', 'Produk tidak ditemukan');
                return redirect()->back();
            }
        }

        if($req->meja){
            $mejaID = (int)$req->meja;
            $meja = Meja::find($mejaID);
            $meja->update([
                'is_active' => 2
            ]);
        }


        if($penjualan) {
            return redirect()->route('nota', ['id' => $penjualan->id])->with('success', 'Berhasil Membuat Pesanan');
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
