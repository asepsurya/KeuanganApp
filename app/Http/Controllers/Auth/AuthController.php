<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  // Tampilkan form login
  public function showLoginForm()
  {
    return view("auth.login"); // Sesuaikan dengan view kamu
  }

  // Proses login
  public function login(Request $request)
  {
    // Validasi input
    $request->validate([
      "email" => "required|string", // Validasi untuk email atau phone
      "password" => "required|string",
    ]);

    // Cek apakah input email atau phone
    $loginField = filter_var($request->email, FILTER_VALIDATE_EMAIL)
      ? "email"
      : "phone";

    // Ambil kredensial (email atau phone)
    $credentials = [
      $loginField => $request->email, // Jika input adalah email, cari dengan email, jika phone, cari dengan phone
      "password" => $request->password,
    ];

    // Coba login
    if (Auth::attempt($credentials)) {
      // Login berhasil
      $request->session()->regenerate();
      return redirect()->intended("dashboard");
    }

    // Login gagal
    return back()
      ->withErrors([
        "email" => "Email atau nomor telepon dan password salah.",
      ])
      ->withInput();
  }
}
