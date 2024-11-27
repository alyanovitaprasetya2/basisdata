<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = User::where('role', 2)->get();
        return view('pages.pegawai.list', [
            'data' => $pegawai
        ]);
    }

    public function add()
    {
        return view('pages.pegawai.add');
    }

    public function doCreate(Request $request)
    {
        $request->validate([
            "nama" => "required"
        ]);

        $pegawai = User::create([
            "username" => $request->nama,
            "email" => $request->email,
            "role" => 2,
            "password" => $request->password,
        ]);

        if($pegawai){
            return redirect()->route('pegawai')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Data gagal ditambahkan');
        }
    }

    public function update($id)
    {
        $pegawai = User::find($id);
        return view('pages.pegawai.update', [
            'data' => $pegawai
        ]);
    }

    public function doUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $pegawai = User::find($id);
        $pegawai->update([
            'username' => $request->nama
        ]);

        if($pegawai){
            return redirect()->route('pegawai')->with('success', 'Berhasil Edit Data');
        } else {
            return redirect()->back()->with('error', 'Gagal Edit Data');
        }
    }

    public function delete($id)
    {
        $pegawai = User::find($id);
        $pegawai->delete();

        if($pegawai)
        {
            return redirect()->route('pegawai')->with('success', 'Berhasil Hapus Data');
        } else {
            return redirect()->back()->with('error', 'Gagal Hapus Data');
        }
    }
}
