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
        return $this->hasMany('App\PatientMessage', 'patient_accounts_username', 'patient_accounts_username');
    }
}
