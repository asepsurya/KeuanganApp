<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\Perusahaan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       App::updateOrCreate(
            ['key' => 'default_rekening'],
            ['value' => '', 'auth' => '1']
        );

        App::updateOrCreate(
            ['key' => 'id_perusahaan'],
            ['value' => 1, 'auth' => '1']
        );



        Perusahaan::updateOrCreate(
            ['auth' => '1'], // kondisi
            [
                'nama_perusahaan' => 'Perusahaan Admin',
                'telp_perusahaan' => '0874541122544',
                'email' => 'sample2025@admin.com',
                'alamat' => 'Tasikmalaya'
            ]
        );
        
    }
}
