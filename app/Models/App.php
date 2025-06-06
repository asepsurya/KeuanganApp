<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $guarded=['id'];
    public function perusahaan(){
        return $this->belongsTo('App\Models\Perusahaan','id_perusahaan','id');
    }
}
