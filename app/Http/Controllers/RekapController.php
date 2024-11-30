<?php

namespace App\Http\Controllers;

use App\Entities\UserEntity;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapController extends Controller
{
    public function index()
    {
        $data = Penjualan::query();

        if(Auth::user()->role === UserEntity::ADMINISTRATOR) {
            $data = $data->where('tempat_id', tempatID());
        } else {
            $data = $data->where('tempat_id', tempatID())
                        ->where('created_by', userID());
        }

        $data = $data->get();

        return view('pages.rekap_penjualan.list', compact('data'));
    }

    public function detail($id)
    {
        $detail = DetailPenjualan::with('penjualan')->where('penjualanID', $id)->get();
        $penjualan = Penjualan::with('user')->where('id', $id)->first();

        return view('pages.rekap_penjualan.detail', [
            'detail' => $detail,
            'penjualan' => $penjualan,
        ]);
    }

    public function nota($id)
    {
        $detail = DetailPenjualan::with('penjualan')->where('penjualanID', $id)->get();
        $penjualan = Penjualan::with('user')->where('id', $id)->first();

        return view('layouts.nota.nota', [
            'detail' => $detail,
            'penjualan' => $penjualan,
        ]);
    }
}
