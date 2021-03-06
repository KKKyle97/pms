<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\PatientMessage;
use App\PatientProfile;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $patientProfilesCount = PatientProfile::where('user_profiles_id',Auth::user()->userProfile->id)->count();
        $notificationCount = PatientMessage::leftJoin('patient_profiles','patient_messages.patient_profiles_id','=','patient_profiles.id')
                                ->where('patient_profiles.user_profiles_id',Auth::user()->userProfile->id)->count();
        
        return view('index',[
            'patientProfilesCount' => $patientProfilesCount,
            'notificationCount' => $notificationCount,
        ]);
    }
}
