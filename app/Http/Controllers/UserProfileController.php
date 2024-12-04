<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function show()
    {
        $data = Auth::user();
        return view('pages.profile.index', compact('data'));
    }
}
