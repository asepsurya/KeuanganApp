<?php

namespace App\Http\Controllers\Produk;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::where('auth', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('produk.index',[
            'activeMenu' => 'produk',
            'active' => 'produk', 
        ],compact('produk'));
    }
    public function category()
    {
        $category = CategoryProduct::all();
        return view('produk.category', [
            'activeMenu' => 'produk',
            'active' => 'category',
        ],compact('category'));
    }
    public function createCategory(Request $request)
    {
        // Logic to create a new category
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create the category (assuming you have a Category model)
        CategoryProduct::create($request->all());
        toastr()->success("Data has been saved successfully!");
        return redirect()->back();
    }
    public function updateCategory(Request $request)
    {
        // Logic to update an existing category
        // Validate the request data
        $request->validate([
            'id' => 'required|exists:category_products,id',
            'name' => 'required|string|max:255',
        ]);

        // Find the category and update it
        $category = CategoryProduct::findOrFail($request->id);
        $category->update($request->all());
        toastr()->success("Data has been updated successfully!");
        return redirect()->back();
    }
    public function deleteCategory($id)
    {
        // Logic to delete a category
        $category = CategoryProduct::findOrFail($id);
        $category->delete();
        toastr()->success("Data has been deleted successfully!");
        return redirect()->back();
    }
    public function create()
    {
        $category = CategoryProduct::all();
        return view('produk.action.add_produk', [
            'activeMenu' => 'produk',
            'active' => 'add_produk',
        ],compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);


        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create([
            'kode_produk' => $request->kode_produk ?? 'PRD-' . uniqid(),
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'berat' => $request->berat ?? 0,
            'auth' => auth()->user()->id,
            'status' => $request->status,
            'kategori' => $request->kategori,
            'gambar' => $gambarPath,
        ]);

        toastr()->success("Data has been saved successfully!");
        return redirect()->back();
    }
    public function update($id)
    {
        $produk = Produk::where('id', $id)->get();
        $category = CategoryProduct::all();
        return view('produk.action.update_produk', [
            'activeMenu' => 'produk',
            'active' => 'produk',
        ], compact('produk', 'category'));
    }

    
    public function updateaction(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
        ]);
    
        // Cari data produk yang akan diupdate
        $produk = Produk::findOrFail($request->id);
    
        // Jika ada gambar baru diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
    
            // Simpan gambar baru
            $produk->gambar = $request->file('gambar')->store('produk', 'public');
        }
    
        // Update data produk
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'berat' => $request->berat ?? $produk->berat,
            'auth' => auth()->user()->id,
            'status' => $request->status ?? $produk->status,
            'kategori' => $request->kategori,
            'gambar' => $produk->gambar, // gunakan yang sudah diset (baru atau lama)
        ]);
    
        toastr()->success("Data has been updated successfully!");
        return redirect()->back();
    }
}
