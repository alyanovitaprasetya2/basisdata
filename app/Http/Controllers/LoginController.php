<?php

namespace App\Http\Controllers;

use App\Models\Tempat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $request->session()->regenerate(); 
            $tempatID = $user->tempat_id;

            $tempat = Tempat::find($tempatID);

            if ($tempat) {
                session()->put('tempat_id', (int) $tempatID);
                session()->put('tempat_nama', $tempat->nama);
                session()->put('tempat_foto', $tempat->foto);
            } else {
                return redirect()->route('login')->withErrors(['error' => 'Tempat tidak ditemukan.']);
            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
