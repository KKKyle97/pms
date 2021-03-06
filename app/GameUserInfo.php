<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Avatar;
use App\PatientAccount;

class GameUserInfo extends Model
{
    //
    protected $fillable = ['name','coin','highscore','is_skipped','avatars_id','patient_accounts_id'];

    public function avatar()
    {
        return $this->hasOne('App\Avatar', 'avatars_id');
    }

    public function account()
    {
        return $this->belongsTo('App\PatientAccount', 'patient_accounts_id');
    }
}
