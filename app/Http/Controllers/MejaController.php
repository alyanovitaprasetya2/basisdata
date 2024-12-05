<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index()
    {
        $meja = Meja::where('tempat_id', tempatID())->get();
        return view('pages.meja.index', compact('meja'));
    }

    public function update(Request $request ,$id)
    {
        $meja = Meja::findOrFail($id);
        $status = $request->input('status');

        if ($status == 1) {
            $meja->is_active = 2; // Kosong → Dipakai
        } elseif ($status == 2) {
            $meja->is_active = 1; // Dipakai → Kosong
        } elseif ($status == 3) {
            $meja->is_active = 1; // Diperbaiki → Kosong
        }

        $meja->save();

        return redirect()->back()->with('success', 'Berhasil merubah status');
    }
}
