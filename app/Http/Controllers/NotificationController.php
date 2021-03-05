<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PatientProfile;
use App\UserProfile;
use App\PatientMessage;
use Auth;
use DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $patients = PatientMessage::select('patient_messages.*','patient_profiles.cancer','patient_profiles.first_name','patient_profiles.last_name','patient_profiles.age')
                    ->leftJoin('patient_profiles','patient_messages.patient_profiles_id','=','patient_profiles.id')
                    ->where('user_profiles_id',Auth::user()->userProfile->id)
                    ->orderBy('patient_messages.is_solved','asc')
                    ->orderBy('patient_messages.score','desc')
                    ->paginate(10);

        return view('notifications.index',[
            'patients' => $patients,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $message = PatientMessage::findOrFail($id);
        $patient = PatientProfile::find($message->patient->id);

        return view('notifications.show',[
            'message' => $message,
            'patient' => $patient,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        PatientMessage::findOrFail($id)->update([
            'is_solved' => 1,
            'solution' => $request->solution,
        ]);

        return redirect()->back()->with('status', 'Thanks for your help!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
