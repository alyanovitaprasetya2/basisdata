<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();

        return view('pages.kategori.category', [
            'kategori' => $kategori
        ]);
    }

    public function add()
    {
        return view('pages.kategori.add');
    }

    public function doCreate(Request $request)
    {
        $request->validate([
            "nama" => 'required'
        ]);

       $kategori = Kategori::create([
        "nama" => $request->nama
       ]);

       if ($kategori) {
        return redirect()->route('kategori')->with('success', 'Berhasil menambah data');
       } else {
        return redirect()->back()->withErrors(['error' => 'Gagal menambah data']);
       }
       
    }
}
