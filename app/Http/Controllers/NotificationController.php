<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
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
        $patients = PatientMessage::select('patient_messages.*','patient_profiles.cancer','patient_profiles.first_name',
                    'patient_profiles.last_name','patient_profiles.age','patient_profiles.ic_number')
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
        // //
        // $message = PatientMessage::find($id);
        
        // if($message != null){
        //     $patient = PatientProfile::find($message->patient->id);

        //     return view('notifications.show',[
        //         'message' => $message,
        //         'patient' => $patient,
        //     ]);
        // }

        // Alert::error('Error', 'Patient Not Found!');
        // return redirect()->route('notifications.index');
        
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
        $message = PatientMessage::find($id);

        if($message != null){
            $message->update([
                'is_solved' => 1,
                'solution' => $request->solution,
            ]);

            return response()->json([
                'message' => 'success',
            ], 200);
        }
        Alert::error('Error', 'Patients Not Found');
        return redirect()->route('notifications.index');
        
        
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

    public function search(Request $request)
    {
        if($request->q != ""){

            $patients = PatientMessage::select('patient_messages.*','patient_profiles.cancer','patient_profiles.first_name','patient_profiles.last_name','patient_profiles.age')
            ->leftJoin('patient_profiles','patient_messages.patient_profiles_id','=','patient_profiles.id')
            ->where('user_profiles_id',Auth::user()->userProfile->id)
            ->where('first_name','LIKE','%'.$request->q.'%')
            ->orWhere('last_name','LIKE','%'. $request->q .'%')
            ->orderBy('patient_messages.is_solved','asc')
            ->orderBy('patient_messages.score','desc')
            ->paginate(10);
                                    
            if (count($patients)>0){
                return view ('notifications.index',[
                    'patients' => $patients
                ]);
            }
        }

        Alert::error('Error', 'Patient Not Found!');
        return redirect()->route('notifications.index');
    }
}
