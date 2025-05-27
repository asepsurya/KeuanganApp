<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ikm extends Model
{
    protected $guarded=['id']; 

    public function User(){
        return $this->belongsTo('App\Models\User','email','email');
    }
}
