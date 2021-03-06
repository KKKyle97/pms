<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientReport extends Model
{
    //
    protected $fillable = ['body_part','level','description','duration','mood','patient_accounts_id','patient_profiles_id'];
    protected $table = 'patient_reports';

    public function account()
    {
        return $this->belongsTo('App\PatientAccount', 'patient_accounts_id', 'patient_accounts_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\PatientProfile', 'patient_profiles_id');
    }
}
