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
        return $this->belongsToMany('App\PatientAccount', 'avatar_user', 'user_id', 'avatar_id');
    }

    public function info()
    {
        return $this->HasOne('App\GameUserInfo','avatars_id');
    }

}
