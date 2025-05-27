<?php

namespace Database\Seeders;

use App\Models\ikm;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    User::updateOrCreate(
      ["email" => "asepsurya1998@gmail.com"],
      [
        "name" => "Administration",
        "phone" => "087731402487",
        "password" => Hash::make("newinopak"),
      ]
    );

     ikm::updateOrCreate(
        ["email" => "asepsurya1998@gmail.com"],
        [
            "nama" => "Administration",
            "telp" => "087731402487",
        ]
        );
    
  }
}
