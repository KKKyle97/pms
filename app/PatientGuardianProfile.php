<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientGuardianProfile extends Model
{
    //
    protected $fillable = ['first_name',
                            'last_name',
                            'ic_number',
                            'relations',
                            'contact',
                            'address_one',
                            'address_two',
                            'postcode',
                            'state',
                            'city',
                            'patient_profiles_id',
];
    protected $table = 'patient_guardian_profiles';

    public function patient()
    {
        return $this->belongsTo('App\PatientProfile','patient_profiles_id');
    }
}
