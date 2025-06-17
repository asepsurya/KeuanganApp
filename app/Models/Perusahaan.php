<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
   protected $guarded=['id'];
   public function legalitas(){
        return $this->hasMany('App\Models\Legalitas','id_perusahaan','id');
    }
}
