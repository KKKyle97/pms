<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    //
    protected $fillable = ['username','password','patient_profiles_id'];
    protected $table = 'patient_accounts';

    public function patient()
    {
        return $this->belongsTo('App\PatientProfile', 'patient_profiles_id');
    }

    public function messages()
    {
        return $this->hasMany('App\PatientMessage', 'patient_accounts_id');
    }

    public function reports(){
        return $this->hasMany('App\PatientReport', 'patient_accounts_id');
    }

    public function info()
    {
        return $this->hasOne('App\GameUserInfo','patient_accounts_id');
    }

    public function avatars()
    {
        return $this->belongsToMany('App\Avatar', 'avatar_user', 'user_id', 'avatar_id');
    }

    public function badges()
    {
        return $this->belongsToMany('App\Badge', 'badge_user', 'user_id', 'badge_id');
    }
}
