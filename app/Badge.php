<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    //
    protected $fillable = [
        'name',
        'type',
        'target'
    ];

    public function users()
    {
        return $this->belongsToMany('App\PatientAccount', 'badge_user', 'user_id', 'badge_id');
    }

    
}
