<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    //
    protected $fillable = [
        'name',
        'cost'
    ];

    public function users()
    {
        return $this->belongsToMany('App\PatientAccount');
    }

    
}
