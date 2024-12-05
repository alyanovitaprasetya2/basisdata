<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $data = Pelanggan::where('tempat_id', tempatID())->get();
        return view('pages.pelanggan.list', compact('data'));
    }

    public function add()
    {
        return view('pages.pelanggan.add');
    }

    public function update($id)
    {
        $data = Pelanggan::find($id);
        return view('pages.pelanggan.update', compact('data'));
    }

    public function doUpdate(Request $request, $id)
    {
        $data = Pelanggan::find($id);
        $data->update([
            "NamaPelanggan" => $request->nama,
            "NomorTelepon" => $request->nomor,
            "Alamat" => $request->alamat
        ]);

        if($data) {
            return redirect()->route('pelanggan')->with('success', 'Data Pelanggan Berhasil Diperbarui');
        } else {
            return redirect()->back()->with('error', 'Data Pelanggan Gagal Dipebarui');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nomor' => 'required'
        ]);

        $pelanggan = Pelanggan::create([
            "NamaPelanggan" => $request->nama,
            "NomorTelepon" => $request->nomor,
            "Alamat" => $request->alamat,
            "tempat_id" => tempatID()
        ]);

        if($pelanggan){
            return redirect()->route('pelanggan')->with('succcess', 'Berhasil Menambah data Pelanggan');
        } else {
            return redirect()->back()->with('error', 'Gagal Menambah data');
        }
    }

    public function delete($id)
    {
        $data = Pelanggan::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }
}
