<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientProfile extends Model
{

    protected $fillable = ['first_name',
                            'last_name',
                            'ic_number',
                            'gender',
                            'age',
                            'cancer',
                            'user_profiles_id'
];
    protected $table = 'patient_profiles';

    public function user()
    {
        return $this->belongsTo('App\UserProfile', 'user_profiles_id');
    }

    public function account()
    {
        return $this->hasOne('App\PatientAccount', 'patient_profiles_id');
    }

    public function guardian()
    {
        return $this->hasOne('App\PatientGuardianProfile', 'patient_profiles_id');
    }

    public function messages()
    {
        return $this->hasMany('App\PatientMessage', 'patient_profiles_id');
    }
    public function reports()
    {
        return $this->hasMany('App\PatientReport', 'patient_profiles_id');
    }
}
