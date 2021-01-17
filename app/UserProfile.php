<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    protected $fillable = ['first_name',
                            'last_name',
                            'ic_number',
                            'gender',
                            'contact',
                            'role',
                            'email',
                            'profile_pic'    
];

    protected $table = 'user_profiles';

    public function user()
    {
        return $this->belongsTo('App\User', 'email', 'email');
    }

    public function patients()
    {
        return $this->hasMany('App\PatientProfile','user_profiles_id');
    }
}
