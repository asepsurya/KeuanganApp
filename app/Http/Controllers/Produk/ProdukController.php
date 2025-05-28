<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk.index',[
            'activeMenu' => 'produk',
            'active' => 'produk', 
        ]);
    }
    public function category()
    {
        return view('produk.category', [
            'activeMenu' => 'produk',
            'active' => 'category',
        ]);
    }
}
