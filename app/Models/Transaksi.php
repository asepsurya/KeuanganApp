<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
     protected $guarded=['id']; 
     public function mitra(){
        return $this->belongsTo('App\Models\Mitra','kode_mitra','kode_mitra');
    }
}
