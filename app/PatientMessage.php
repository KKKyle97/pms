<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientMessage extends Model
{
    //
    protected $fillable = ['score','message','is_solved','solution','patient_accounts_username','patient_profiles_id'];
    protected $table = 'patient_messages';

    public function account()
    {
        return $this->belongsTo('App\PatientAccount', 'patient_accounts_username', 'patient_accounts_username');
    }

    public function patient()
    {
        return $this->belongsTo('App\PatientProfile', 'patient_profiles_id');
    }
}
