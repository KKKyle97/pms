<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PatientAccount;
use Illuminate\Support\Facades\Hash;

class GameController extends Controller
{
    //
    public function login(Request $request)
    {
        //
        $patient = PatientAccount::where('username',$request->username)->first();
    
        if($patient == null)
            echo "user not found";
        else if(Hash::check($request->password,$patient->password))
        {
            echo "Logged In!";
        }
        else
        {
            echo "Incorrect Password!";
        }
    }
}
