<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::where('tempat_id', tempatID())->get();
        return view("pages.produk.produk", compact('produk'));
    }

    public function add()
    {
        $kategori = Kategori::where('tempat_id', tempatID())->get();
        return view("pages.produk.add", compact(['kategori']));
    }

    public function update($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::where('tempat_id', tempatID())->get();
        return view('pages.produk.update', [
            "data" => $produk,
            "kategori" => $kategori
        ]);
    }

    public function doUpdate(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required',
            'kategori' => 'required',
            'harga'    => 'required',
            'stok'     => 'required',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $produk = Produk::findOrFail($id); 

        $path = $produk->image_path; 
        if ($request->hasFile('image')) {
            if ($produk->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->image_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($produk->image_path);
            }
            $path = $request->file('image')->store('images', 'public');
        }

        $produk->update([
            'NamaProduk'  => $request->nama,
            'Price'       => $request->harga,
            'Stok'        => $request->stok,
            'image_path'  => $path,
            'kategori_id' => $request->kategori,
        ]);

        return redirect()->route('produk')->with('success', 'Produk Berhasil Diperbarui');
    }


    public function doCreate(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'kategori' => 'required',
            'image'    => 'required|image|mimes: jpeg,png,jpg',
            'harga'    => 'required',
            'stok'     => 'required',
        ]);

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
        }

        $produk = Produk::create([
            'NamaProduk'  => $request->nama,
            'Price'       => $request->harga,
            'Stok'        => $request->stok,
            'image_path'  => $path,
            'Harga'       => null,
            'kategori_id' => $request->kategori,
            'tempat_id'   => tempatID()
        ]);

        if($produk){
            return redirect()->route('produk')->with('success', 'Produk Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Produk Gagal Ditambahkan');
        }
    }

    public function delete($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->image_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($produk->image_path);
        }

        $produk->delete();
        return redirect()->route('produk')->with('success', 'Berhasil Menghapus data');
    } 
}
