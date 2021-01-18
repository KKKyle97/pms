<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserProfile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    protected function validateForm(array $data,$id)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'ic_number' => ['required', 'string', 'min:12','max:12',Rule::unique('patient_profiles')->ignore($id)],
            'contact' => ['required','string', 'min:10', 'max:11',],
        ]);
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
        
        return view('users.show',[
            'userProfile' => Auth::user()->userProfile,
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
        return view('users.edit',[
            'userProfile' => Auth::user()->userProfile
        ]);
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
        $user = UserProfile::findOrFail($id);

        $validator = $this->validateForm($request->all(),$id);

        if ($validator->fails()) {
            return redirect('users/'.$id.'/edit')->withErrors($validator);
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'ic_number' => $request->ic_number,
            'gender' => $request->gender,
            'contact' => $request->contact,
            'hospital_code' => $request->hospital_code,
            'role' => $request->role,
        ]);

        return redirect()->route('users.show',[$id])->with('status', 'User Profile Updated!');

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
