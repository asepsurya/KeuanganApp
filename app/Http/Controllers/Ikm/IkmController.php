<?php

namespace App\Http\Controllers\Ikm;

use App\Models\ikm;
use App\Models\User;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class IkmController extends Controller
{
  public function index()
  {
    $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
    $ikm = ikm::all()->sortByDesc("created_at")->map(function ($item) {
        $foto = $item->foto ? asset('storage/' . $item->foto) : asset('assets/images/byewind-avatar.png');
       return [
             '<a href="' . route("ikm.update", $item->id) . '" class="flex items-center space-x-2 text-blue-600 hover:underline">
                <img class="w-6 h-6 rounded-full object-cover ring-2 ring-white dark:ring-black" src="' . $foto . '" alt="Foto">
                <span>' . e($item->nama) . '</span>
            </a>',
            
            '<div class="">'. ($item->jenis_kelamin === 'L' ? '<span class="text-blue-500">Laki-laki</span>' :
            ($item->jenis_kelamin === 'P' ? '<span class="text-pink-500">Perempuan</span>' :
            '<span class="text-gray-500">Tidak Diketahui</span></div>')) . '</div>',

           '<div class="mobile">' . ($item->kota?->name ?? '<span class="text-gray-500">Tidak Diketahui</span>') . '</div>',
            '<div class="mobile">' .($item->telp ?? '<span class="text-gray-500">Tidak Diketahui</span>') . '</div>',
            '<div class="mobile">' . ($item->email ?? '<span class="text-gray-500">Tidak Diketahui</span>') .'</div>',
        ];

      })->values();
        // Hitung jumlah berdasarkan jenis kelamin
     $jumlah = ikm::select('jenis_kelamin', DB::raw('count(*) as total'))->whereIn('jenis_kelamin', ['L', 'P'])
        ->groupBy('jenis_kelamin')
        ->pluck('total', 'jenis_kelamin'); 

      return view("ikm.index",[
        "activeMenu" => "ikm",
        "active" => "ikm",
      ],compact("ikm", "jumlah","logs"));
  }

  public function create()
  {
    $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
    $provinsi = Province::all();
    return view("ikm.action.add",[
        "activeMenu" => "ikm_create",
        "active" => "ikm_create",
      ],compact("provinsi","logs")
    );
  }

  public function store(Request $request)
  {
    // Validasi input
    $validatedData = $request->validate([
      "nik" => "required|string|max:20|unique:ikms,nik",
      "nama" => "required|string|max:255",
      "tempat_lahir" => "required|string|max:255",
      "tanggal_lahir" => "required|date",
      "jenis_kelamin" => "required|in:L,P",
      "alamat" => "required|string|max:255",
      "rt" => "nullable|string|max:10",
      "rw" => "nullable|string|max:10",
      "id_provinsi" => "nullable|integer",
      "id_kota" => "nullable|integer",
      "id_kecamatan" => "nullable|integer",
      "id_desa" => "nullable|integer",
      "agama" => "nullable|string|max:50",
      "status_perkawinan" => "nullable|string|max:50",
      "pekerjaan" => "nullable|string|max:100",
      "kewarganegaraan" => "nullable|string|max:50",
      "telp" => "required|string|max:20",
      "sosmed" => "nullable|string|max:100",
      "website" => "nullable|url|max:255",
      "email" => "required|email|max:255",
     
    ]);


    // Simpan data ke database
    $ikm = ikm::create($validatedData);
    // Log aktivitas
    activity('ikm')->performedOn($ikm)->causedBy(auth()->user())->log('Menambahkan Data Pengguna');
    // Simpan user terkait
    User::create([
      'name' => $validatedData['nama'],
      'phone'=>$validatedData['telp'],
      'email' => $validatedData['email'], // Gunakan NIK sebagai email default jika tidak ada
      'password' => $validatedData['telp'],
    ]);
    toastr()->success("Data has been saved successfully!");
    return redirect()->route("index.ikm");
  }
  public function update($id)
  {
    $logs = Activity::where(['causer_id'=>auth()->user()->id, 'log_name' => 'ikm'])->latest()->take(10)->get();
    $provinsi = Province::all();
    $ikm = ikm::where("id", $id)->first(); // Pakai first() langsung

    if (!$ikm) {
      abort(404); // Data tidak ditemukan
    }

    // Ambil semua field sebagai array
    $data = $ikm->toArray();

    // Hitung presentase kelengkapan data
    $totalFields = count($data);
    $emptyFields = collect($data)
      ->filter(function ($value) {
        return empty($value);
      })
      ->count();

    $filledFields = $totalFields - $emptyFields;
    $percentage = intval(($filledFields / $totalFields) * 100);

    // Kirim semua data ke view dalam satu array
    return view("ikm.action.edit", [
      "activeMenu" => "ikm_update",
      "active" => "ikm",
      "ikm" => $ikm,
      "provinsi" => $provinsi,
      "percentage" => $percentage,
      'emptyFields' => $emptyFields
    ],compact("id","logs"));
  }

    public function updateFoto(Request $request)
    {
        // Validate inputs
        $request->validate([
            'id' => 'required|exists:ikms,id',
            'croppedFoto' => 'required|string', // Base64 string
        ]);

        try {
            // Extract the Base64 string
            $base64Image = $request->input('croppedFoto');

            // Decode and process the image
            $imageParts = explode(';base64,', $base64Image);
            $imageType = explode('image/', $imageParts[0])[1]; // Get extension (e.g., jpeg, png)
            $imageBase64 = base64_decode($imageParts[1]);

            // Generate unique file name
            $fileName = 'ikm-foto/' . uniqid() . '.' . $imageType;

            // Save to storage
            Storage::disk('public')->put($fileName, $imageBase64);


            // Delete old image if it exists
            if ($request->oldImage) {
                Storage::delete($request->oldImage); // Deletes from `storage/app`
            }

            // Update database with new image path
            ikm::where('id', $request->id)->update(['foto' => $fileName]);
            $ikm = ikm::find($request->id);
            // Log the activity
            if($ikm){
                activity('ikm')->performedOn($ikm)->causedBy(auth()->user())->log('Memperbarui Foto Profil Pengguna');
            }       
            
            toastr()->success('Profile photo updated successfully.');
            return redirect()->back();

        } catch (\Exception $e) {
            toastr()->error('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function updateIkm(Request $request)
    {
     // Validasi input
        $validatedData = $request->validate([
            "nik" => "required|string|max:20",
            "nama" => "required|string|max:255",
            "tempat_lahir" => "required|string|max:255",
            "tanggal_lahir" => "required|date",
            "jenis_kelamin" => "required|in:L,P",
            "alamat" => "required|string|max:255",
            "rt" => "nullable|string|max:10",
            "rw" => "nullable|string|max:10",
            "id_provinsi" => "nullable|integer",
            "id_kota" => "nullable|integer",
            "id_kecamatan" => "nullable|integer",
            "id_desa" => "nullable|integer",
            "agama" => "nullable|string|max:50",
            "status_perkawinan" => "nullable|string|max:50",
            "pekerjaan" => "nullable|string|max:100",
            "kewarganegaraan" => "nullable|string|max:50",
            "telp" => "nullable|string|max:20",
            "sosmed" => "nullable|string|max:100",
            "website" => "nullable|url|max:255",
            "email" => "nullable|email|max:255",
        
        ]);

        // Update data di database
        ikm::where('id',$request->id)->update($validatedData);
        User::where('email',$validatedData['email'])->update([
            'name' => $validatedData['nama'],
            'phone'=>$validatedData['telp'],
        ]);
          $ikm = ikm::find($request->id);
            // Log the activity
            if($ikm){
                activity('ikm')->performedOn($ikm)->causedBy(auth()->user())->log('Memperbarui Data Pengguna');
            }  
         toastr()->success("Data has been saved successfully!");
        return redirect()->back();
     }

    public function delete($id)
    {

        $ikm = ikm::find($id);
        if ($ikm) {
            activity('ikm')
                ->performedOn($ikm)
                ->causedBy(auth()->user())
                ->log('Menghapus Data Pengguna');

            if ($ikm->foto) {
                Storage::disk('public')->delete($ikm->foto);
            }
            
            $ikm->delete();

            // Hapus user terkait
            $user = User::where('email', $ikm->email ?? '')->first();
            if ($user) {
                $user->delete();
            }
        }

        toastr()->success("Data has been deleted successfully!");
        return redirect()->route("index.ikm");
    }
}
