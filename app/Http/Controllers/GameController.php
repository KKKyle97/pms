<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PatientAccount;
use App\Avatar;
use App\badge;
use App\GameUserInfo;
use Illuminate\Support\Facades\Hash;
use DB;

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
            $userInfo = GameUserInfo::where('patient_accounts_id',$patient->id)->first();

            if($userInfo != null){
                echo "logged in";
            }else{
                echo "first time";
            }
        }
        else
        {
            echo "Incorrect Password!";
        }
    }

    public function firstLogin(Request $request)
    {
        $patient = PatientAccount::where('username',$request->username)->first();
        $patient->info()->create([
            'name' => $request->name,
            'coin' => 0,
            'highscore' => 0,
            'avatars_id' => $request->avatarId,
        ]);

        return response()->json($patient->info, 200);
    }

    public function updateScore(Request $request)
    {
        $user = PatientAccount::findOrFail($request->userid);

        $user->coin += $request->coin;

        if($user->highscore < $request->highscore)
            $user->highscore = $request->highscore;

        $user->save();

        return response()->json([
            'message' => 'Updated successfully',
        ]);
    }

    public function getScore(Request $request)
    {
        $user = PatientAccount::findOrFail($request->userId);

        return response()->json([
            'coin' => $user->coin,
            'highScore' => $user->highscore,
        ]);
    }

    public function buyAvatar(Request $request)
    {
        $avatar = Avatar::findOrFail($request->avatarId);
        $user = PatientAccount::findOrFail($request->userId);
        
        if($avatar->cost > $user->coin)
        {
            return response()->json([
                'message' => 'insufficient coin',
            ]);
        }
        else
        {
            $user->coin -= $avatar->cost;
            $user->save();

            $user = PatientAccount::findOrFail($request->userId);

            $user->avatars()->attach($request->avatarId);

            return response()->json([
                'message' => 'Purchased successfully',
            ]);
        }
    }

    public function getAvatars(Request $request)
    {
        $records = DB::table('avatar_user')->where('user_id',$request->userId)->get();
        return json_encode($records);
    }

    public function unlockBadge(Request $request)
    {
      //todo: unlock badges
    }
}
