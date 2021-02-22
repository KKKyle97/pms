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
        return response()->json([
            'message' => 'user not found',
            'data' => ''
        ], 200);
        else if(Hash::check($request->password,$patient->password))
        {
            $userInfo = GameUserInfo::where('patient_accounts_id',$patient->id)->first();

            if($userInfo != null){
                return response()->json([
                    'message' => 'logged in',
                    'data' => json_encode($userInfo)
                    // 'data' => $userInfo
                ], 200);
            }else{
                return response()->json([
                    'message' => 'first time',
                    'data' => ''
                ], 200);
            }
        }
        else
        {
            return response()->json([
                'message' => 'incorrect password',
                'data' => ''
            ], 200);
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

        $patient->avatars()->attach(1);
        $patient->avatars()->attach(2);

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

    public function changeAvatar(Request $request)
    {
        $user = GameUserInfo::where('id',$request->userId)->update(['avatars_id' => $request->avatarId]);

        return response()->json([
            'message' => 'success'
        ], 200);
                
    }

    public function getAvatars($id)
    {
        $records = DB::table('avatar_user')->select('avatar_id')->where('user_id',$id)->get();
        return response()->json([
            'message' => 'success',
            'data' => json_encode($records),
        ], 200);
    }

    public function unlockAvatar(Request $request)
    {
        $user = GameUserInfo::find($request->userId);
        $avatar = Avatar::find($request->avatarId);
        if($user->coin >= $avatar->cost){
            $account = PatientAccount::find($request->accId);
            $account->avatars()->attach($request->avatarId);

            $user->update(['coin' => $user->coin - $avatar->cost]);

            return response()->json([
                'message' => 'success'
            ], 200);
        }else{
            return response()->json([
                'message' => 'insufficient coin'
            ], 200);
        }
    }

    public function unlockCoinBadge(Request $request)
    {
        //todo: unlock coin badges
        $userInfo = GameUserInfo::find($request->id);
        $user = $userInfo->account;


        $badges = Badge::whereNotIn('id',function($query) {
                $query->select('badge_id')->from('badge_user');
            })->where('target','<=',$request->coin)
            ->where('type',1)
            ->get();
      
        foreach ($badges as $badge) {
            $user->badges()->attach($badge->id);
        }

        return response()->json([
          'data' => $badges
        ], 200);
    }

    public function unlockReportBadge(Request $request)
    {
        $acc = PatientAccount::find($request->accId);
        $reportCount = $acc->reports()->count();

        $badges = Badge::whereNotIn('id',function($query) {
            $query->select('badge_id')->from('badge_user');
                    })->where('target','<=',$reportCount)
                    ->where('type',2)
                    ->get();
        
        foreach ($badges as $badge) {
            $user->badges()->attach($badge->id);
        }

        return response()->json([
            'data' => $badges
          ], 200);
    }

    public function unlockAvatarBadge(Request $request)
    {
        $userInfo = GameUserInfo::find($request->id);
        $user = $userInfo->account;

        $avatarCount = $user->avatars()->count();
  
  
        $badges = Badge::whereNotIn('id',function($query) {
          $query->select('badge_id')->from('badge_user');
                  })->where('target','<=',$avatarCount)
                  ->where('type',3)
                  ->get();
        
        foreach ($badges as $badge) {
            $user->badges()->attach($badge->id);
        }
  
        return response()->json([
            'data' => $badges
          ], 200);
    }

    public function getAllBadges($id)
    {
        $user = PatientAccount::find($id);
        $badges = DB::table('badge_user')->select('badges.id','badges.type')
                    ->rightJoin('badges','badge_user.badge_id','=','badges.id')
                    ->where('badge_user.user_id',$id)
                    ->get();
        

        return response()->json([
            'message' => 'success',
            "data" => json_encode($badges)
        ], 200);
    }

    public function sendReport(Request $request)
    {
        $acc = PatientAccount::find($request->accId);
        $acc->reports()->create([
            'body_part' => $request->bodyPart,
            'level' => $request->level,
            'description' => $request->description,
            'duration' => $request->duration,
            'mood' => $request->mood
        ]);

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function sendMessage(Request $request)
    {
        $patient = PatientAccount::findOrFail($request->patientAccountId);

        $isCreated = $patient->messages()->create([
            'score' => $request->score,
            'message' => $request->message,
            'patient_profiles_id' => $patient->patient_profiles_id
        ]);

        if($isCreated)
        {
            echo "messages added";
        }
        else
        {
            echo "error";
        }
    }

    public function loadProfile($id)
    {
        $userInfo = DB::table('game_user_infos')
                    ->leftJoin('badge_user','game_user_infos.patient_accounts_id','=','badge_user.user_id')
                    ->select('game_user_infos.*',DB::raw('count(badge_user.user_id) as badges_count'))
                    ->first();

        if($userInfo != null)
        {
            return response()->json([
                'message' => 'success',
                'data' => json_encode($userInfo) 
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'user not found',
                'data' => ''
            ], 200);
        }
    }
}
