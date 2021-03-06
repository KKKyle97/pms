<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
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

    public function info()
    {
        return $this->HasOne('App\GameUserInfo');
    }

}
