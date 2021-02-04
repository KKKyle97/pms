<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    //
    protected $fillable = ['username','password','coin','highscore','patient_profiles_id'];
    protected $table = 'patient_accounts';

    public function patient()
    {
        return $this->belongsTo('App\PatientProfile', 'patient_profiles_id');
    }

    public function messages()
    {
        return $this->hasMany('App\PatientMessage', 'patient_accounts_username', 'patient_accounts_username');
    }

    public function avatars()
    {
        return $this->belongsToMany('App\Avatar', 'avatar_user', 'user_id', 'avatar_id')->withPivot('is_selected');
    }

    public function badges()
    {
        return $this->belongsToMany('App\Badge', 'badge_user', 'user_id', 'badge_id');
    }
}
