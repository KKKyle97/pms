<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use App\PatientProfile;
use App\PatientReport;
use App\UserProfile;
use App\Common;
use Auth;
use DB;

class PatientController extends Controller
{
     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateForm(array $data,bool $isUpdate,int $id)
    {
        
        $validateRules = [
            // patient profile validator
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'age' => ['required'],
            'cancer' => ['required'],

            //guardian profile validator
            'gfirst_name' => ['required', 'max:255','string'],
            'glast_name' => ['required', 'string', 'max:255'],
            'relations' => ['required'],
            'contact' => ['required','string', 'min:10', 'max:11'],
            'address_one' => ['required'],
            'address_two' => ['required'],
            'postcode' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
        ];

        if($isUpdate){
            $validateRules['ic_number'] = ['required', 'string', 'min:12','max:12',Rule::unique('patient_profiles')->ignore($id)];
            $validateRules['gic_number'] = ['required', 'string', 'min:12','max:12','unique:patient_guardian_profiles,ic_number,'.$id];
        }else{
            $validateRules['ic_number'] = ['required', 'string', 'min:12','max:12','unique:patient_profiles'];
            $validateRules['gic_number'] = ['required', 'string', 'min:12','max:12','unique:patient_guardian_profiles,ic_number'];
            $validateRules['username'] = ['required', 'string', 'max:255', 'unique:patient_accounts'];
            $validateRules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }


        return Validator::make($data, $validateRules);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $patients = PatientProfile::where('user_profiles_id',Auth::user()->userProfile->id)->paginate(10);
        
        return view('patients.index',[
            'patients' => $patients
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
        return view('patients.create');
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
        $user = UserProfile::where('email',Auth::user()->email)->first();

        $validator = $this->validateForm($request->all(),false,0);

        if ($validator->fails()) {
            return redirect('patients/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $user->patients()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'ic_number' => $request->ic_number,
            'gender' => $request->gender,
            'age' => $request->age,
            'cancer' => $request->cancer,
        ]);

        $patient = PatientProfile::where('ic_number',$request->ic_number)->first();

        $patient->guardian()->create([
            'first_name' => $request->gfirst_name,
            'last_name' => $request->glast_name,
            'ic_number' => $request->gic_number,
            'relations' => $request->relations,
            'contact' => $request->contact,
            'address_one' => $request->address_one,
            'address_two' => $request->address_two,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'state' => $request->state,
        ]);

        $patient->account()->create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        
        Alert::success('Success', 'Patient Added Successfully!');
        return redirect()->route('home');
        
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
        $patient = PatientProfile::find($id);

        if($patient != null){
            $guardian = $patient->guardian;
            $account = $patient->account;

            $currentMoodAndPainLevel =  DB::table('patient_reports')
            ->select('mood','level')
            ->where('patient_profiles_id',$id)
            ->orderBy('created_at','desc')
            ->first();

            $painLocation =  DB::table('patient_reports')
            ->select(DB::raw('count(body_part) as count'),'body_part')
            ->where('patient_profiles_id',$id)
            ->groupBy('body_part')
            ->orderBy('count', 'desc')
            ->first();

            $avgPainLevel = DB::table('patient_reports')
            ->select(DB::raw('avg(level) as count'))
            ->where('patient_profiles_id',$id)
            ->first();

            $avgPainLevel->count = intval($avgPainLevel->count);
    
            return view('patients.show',[
                'patient' => $patient,
                'guardian' => $guardian,
                'account' => $account,
                'currentMoodAndPainLevel' => $currentMoodAndPainLevel,
                'painLocation' => $painLocation,
                'avgPainLevel' => $avgPainLevel,
            ]);
        }
        Alert::error('Error', 'Patient Not Found!');
        return redirect()->route('patients.index');
        
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
        $patient = PatientProfile::find($id);

        if($patient != null){
            $guardian = $patient->guardian;

            return view('patients.edit',[
                'patient' => $patient,
                'guardian' => $guardian,
            ]);
        }

        return redirect()->route('patients.show', [$id]);
        
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
        $patient = PatientProfile::find($id);

        if($patient != null){
            $validator = $this->validateForm($request->all(), true, $id);

            if ($validator->fails()) {
                return redirect('patients/'.$id.'/edit')->withErrors($validator);
            }
            
            $patient->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'ic_number' => $request->ic_number,
                'gender' => $request->gender,
                'age' => $request->age,
                'cancer' => $request->cancer,
            ]);

            $patient->guardian()->update([
                'first_name' => $request->gfirst_name,
                'last_name' => $request->glast_name,
                'ic_number' => $request->gic_number,
                'relations' => $request->relations,
                'contact' => $request->contact,
                'address_one' => $request->address_one,
                'address_two' => $request->address_two,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'state' => $request->state,
            ]);
            
            Alert::success('Success', 'Patient Info Updated Successfully!');
            return redirect()->route('patients.show',[$id]);
        } 
        return redirect()->route('patients.show',[$id]);
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
        PatientProfile::destroy($id);

        
        return redirect()->route('patients.index')->withSuccess('Paitent Deleted Successfully!');
    }

    public function search(Request $request)
    {
        if($request->q != ""){
            $patients = PatientProfile::where('user_profiles_id',Auth::user()->userProfile->id)
                                    ->where('first_name','LIKE','%'.$request->q.'%')
                                    ->orWhere('last_name','LIKE','%'. $request->q .'%')
                                    ->orWhere('ic_number','LIKE','%'. $request->q .'%')
                                    ->paginate(10);
                                    
            if (count($patients)>0){
                return view ('patients.index',[
                    'patients' => $patients
                ]);
            }
        }

        Alert::error('Error', 'Patient Not Found!');
        return redirect()->route('patients.index');
    }

    public function analyse($id){
        $patient = PatientProfile::find($id);

        if($patient != null){
            $reportsCount = PatientProfile::find($id)->reports()->count();
            $reports = PatientProfile::findOrFail($id)->reports()->orderBy('created_at')->get();
            

            $bodyPartsCount =  DB::table('patient_reports')
            ->select(DB::raw('count(*) as count'),'body_part')
            ->where('patient_profiles_id',$id)
            ->groupBy('body_part')
            ->orderBy('count', 'desc')
            ->get();

            $descriptionCount =  DB::table('patient_reports')
            ->select(DB::raw('count(*) as count'),'description','body_part')
            ->where('patient_profiles_id',$id)
            ->groupBy('description','body_part')
            ->orderBy('count', 'desc')
            ->get();

            $highestPainLevel =  DB::table('patient_reports')
            ->select(DB::raw('max(level) as level'),'description','body_part','created_at')
            ->where('patient_profiles_id',$id)
            ->groupBy('description','body_part')
            ->orderBy('created_at')
            ->get();

            $durationPerBodyPart = DB::table('patient_reports')
            ->select(DB::raw('max(duration) as duration,avg(duration) as average'),'body_part','created_at')
            ->where('patient_profiles_id',$id)
            ->groupBy('body_part')
            ->orderBy('created_at')
            ->get();

            return view('patients.analyse',[
                'reports' => $reports,
                'patient' => $patient,
                'bodyPartsCount' => $bodyPartsCount,
                'descriptionCount' => $descriptionCount,
                'highestPainLevel' => $highestPainLevel,
                'durationPerBodyPart' => $durationPerBodyPart,
                'reportsCount' => $reportsCount
            ]);
        }

        Alert::error('Error', 'Patient Not Found!');
        return redirect()->route('home');
        
    }
}