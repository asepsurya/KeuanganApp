<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
     protected $guarded=['id']; 
     public function mitra(){
        return $this->belongsTo('App\Models\Mitra','kode_mitra','kode_mitra');
    }
     public function penawaran(){
        return $this->hasMany('App\Models\Penawaran','kode_mitra','kode_mitra');
    }
     public function perusahaan(){
        return $this->belongsTo('App\Models\Perusahaan','auth','auth');
    }
   
}
