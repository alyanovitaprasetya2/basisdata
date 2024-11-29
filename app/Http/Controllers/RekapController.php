<?php

namespace App\Http\Controllers;

use App\Entities\UserEntity;
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
}
