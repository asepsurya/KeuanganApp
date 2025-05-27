<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class registerController extends Controller
{
  public function register()
  {
    return view("auth.register");
  }

  public function registerAction(Request $request)
  {
    $validator = Validator::make($request->all(), [
      "name" => "required|string|max:255",
      "phone" => "required|string|max:15",
      "email" => "required|email|unique:users,email",
      "password" => "required|string|min:8|same:cpassword",
      "captcha" => "required|captcha",
    ]);

    if ($validator->fails()) {
      // Mengirim kembali ke form dengan pesan error
      return back()->withErrors($validator)->withInput();
    }

    // Simpan data pengguna ke database
    $user = User::create([
      "name" => $request->name,
      "phone" => $request->phone,
      "email" => $request->email,
      "password" => Hash::make($request->password),
    ]);


    toastr()->success("Data has been saved successfully!");
    return redirect()->back();
  }
}
