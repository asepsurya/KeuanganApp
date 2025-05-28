<?php

namespace App\Http\Controllers\Ikm;

use App\Models\ikm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IkmController extends Controller
{
    public function index()
    {
        $ikm = ikm::all()->sortByDesc('created_at')->map(function($item) {
            return [
        
                '<a href="' . route('ikm.update', $item->id) . '" class="text-blue-600 hover:underline">' . e($item->nama) . '</a>',
                $item->alamat ?? 'Belum disetel',
                $item->telp ?? 'Belum disetel',
                $item->email ?? 'Belum disetel',
            ];
        })->values();
        return view('ikm.index', [
            'activeMenu' => 'ikm',
            'active' => 'ikm',
        ],compact('ikm'));
    }

    public function create()
    {
        return view('ikm.action.add', [
            'activeMenu' => 'ikm_create',
            'active' => 'ikm_create',
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nik' => 'required|string|max:20|unique:ikms,nik',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string|max:255',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'id_provinsi' => 'nullable|integer',
            'id_kota' => 'nullable|integer',
            'id_kecamatan' => 'nullable|integer',
            'id_desa' => 'nullable|integer',
            'agama' => 'nullable|string|max:50',
            'status_perkawinan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'kewarganegaraan' => 'nullable|string|max:50',
            'telp' => 'nullable|string|max:20',
            'sosmed' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|max:2048', // Maks 2MB
        ]);

        // Jika ada file foto diupload
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('ikm-foto', 'public');
            $validatedData['foto'] = $path;
        }

        // Simpan data ke database
        ikm::create($validatedData);

        return redirect()->route('index.ikm')->with('success', 'Data IKM berhasil ditambahkan.');
    }
    public function update($id)
    {
        // Logika untuk menampilkan form update IKM
        // Misalnya, ambil data IKM berdasarkan ID dan kirim ke view
        $ikm = ikm::where('id',$id)->get(); // Pastikan ID valid
        return view('ikm.action.edit', [
            'activeMenu' => 'ikm_update',
            'active' => 'ikm',
        ], compact('ikm'));
    }
}
