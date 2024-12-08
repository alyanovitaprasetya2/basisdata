<?php

namespace App\Http\Controllers;

use App\Entities\UserEntity;
use App\Models\Tempat;
use App\Models\User;
use Illuminate\Http\Request;

class SuperController extends Controller
{
    public function users()
    {
        $data = User::where('role', '!=', UserEntity::SUPER_ADMIN)->get();
        return view('pages.super.user.index', compact('data'));
    }

    public function createUser()
    {   
        $tempat = Tempat::all();
        return view('pages.super.user.add', compact('tempat'));
    }

    public function doCreateUser(Request $request)
    {
        $request->validate([
            "username" => "required",
            "role" => "required",
            "email" => "required",
            "password" => "required",
            "tempat" => "required",
        ]);

        $user = User::create([
            "username" => $request->username,
            "role" => $request->role,
            "email" => $request->email,
            "password" => $request->password,
            "tempat_id" => $request->tempat,
        ]);

        if($user){
            return redirect()->route('users')->with('success', 'User Berhasil Ditambahkan');
        } else {
            return redirect()->route('users')->with('error', 'User Gagal Ditambahkan');
        }
    }

    public function tempat()
    {
        $data = Tempat::all();
        return view('pages.super.tempat', compact('data'));
    }
}
