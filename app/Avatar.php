<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    //
    protected $fillable = [
        'name',
        'target'
    ];

    public function users()
    {
        return $this->belongsToMany('App\PatientAccount');
    }

    public function info()
    {
        return $this->belongsTo('App\GameUserInfo');
    }

}
