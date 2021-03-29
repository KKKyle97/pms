<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PatientAccount;
use App\Avatar;
use App\Badge;
use App\GameUserInfo;
use Illuminate\Support\Facades\Hash;
use DB;

class GameController extends Controller
{
    const NOBADGE = 'no badges';
    //
    public function login(Request $request)
    {
        //
        $patient = PatientAccount::where('username',$request->username)->first();
    
        if($patient == null){
            return response()->json([
                'message' => 'user not found',
                'data' => ''
            ], 200);
        }
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
            'coin' => 1000,
            'highscore' => 0,
            'is_skipped' => false,
            'avatars_id' => $request->avatarId,
        ]);

        $patient->avatars()->attach(1);
        $patient->avatars()->attach(2);

        return response()->json([
            "message" => "success",
            "data" => json_encode($patient->info)
        ], 201);
    }

    public function updateScore(Request $request)
    {
        $user = GameUserInfo::find($request->userId);

        $user->coin += $request->coin;

        if($user->highscore < $request->highScore){
            $user->highscore = $request->highScore;
        }
        
        $user->save();

        return response()->json([
            "message" => "success",
            "data" => ""
        ], 200);
    }

    public function getScore($id)
    {
        $user = GameUserInfo::find($id);

        return response()->json([
            "message" => "success",
            "data" => ['coin' => $user->coin,
                        'highScore' => $user->highscore]
        ],200);
    }

    public function changeAvatar(Request $request)
    {
        GameUserInfo::where('id',$request->userId)->update(['avatars_id' => $request->avatarId]);

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
        $user = PatientAccount::find($request->accId);


        $badges = Badge::whereNotIn('id',function($query) {
                $query->select('badge_id')->from('badge_user');
            })->where('target','<=',$request->coin)
            ->where('type',1)
            ->get();

        foreach ($badges as $badge) {
            $user->badges()->attach($badge->id);
        }

        if($badges->count() == 0)
        {
            return response()->json([
                'message' => self::NOBADGE,
                'data' => $badges
              ], 200);
        }else
        {
            return response()->json([
                'message' => 'success',
                'data' => $badges
              ], 201);
        }
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
            $acc->badges()->attach($badge->id);
        }

        if($badges->count() == 0)
        {
            return response()->json([
                'message' => self::NOBADGE,
                'data' => $badges
              ], 200);
        }else
        {
            return response()->json([
                'message' => 'success',
                'data' => $badges
              ], 201);
        }
        
    }

    public function unlockAvatarBadge(Request $request)
    {
        $user = PatientAccount::find($request->accId);

        $avatarCount = $user->avatars()->count();
  
        $id = $request->accId;
        $badges = Badge::whereNotIn('id',function ($query) use ($id) {
          $query->select('badge_id')->from('badge_user')->where('user_id',$id);
                  })->where('target','<=',$avatarCount)
                  ->where('type',3)
                  ->get();
        
        foreach ($badges as $badge) {
            $user->badges()->attach($badge->id);
        }
  
        if($badges->count() == 0)
        {
            return response()->json([
                'message' => self::NOBADGE,
                'data' => $badges
              ], 200);
        }else
        {
            return response()->json([
                'message' => 'success',
                'data' => $badges
              ], 201);
        }
    }

    public function getAllBadges($id)
    {
        $badges = DB::table('badges')
                    ->leftJoin('badge_user','badge_user.badge_id','=','badges.id')
                    ->select('badges.id','badges.type')
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
            'mood' => $request->mood,
            'patient_profiles_id' => $acc->patient_profiles_id,
        ]);

        return response()->json([
            'message' => 'success'
        ], 201);
    }

    public function sendMessage(Request $request)
    {
        $patient = PatientAccount::find($request->accId);

        $patient->messages()->create([
            'score' => $request->score,
            'message' => $request->message,
            'is_solved' => 0,
            'patient_profiles_id' => $patient->patient_profiles_id
        ]);

        return response()->json([
            'message' => 'success'
        ], 201);
    }

    public function loadProfile($id)
    {
        $userInfo = DB::table('game_user_infos')
                    ->leftJoin('badge_user','game_user_infos.patient_accounts_id','=','badge_user.user_id')
                    ->select('game_user_infos.*',DB::raw('count(badge_user.user_id) as badges_count'))
                    ->where('game_user_infos.id',$id)
                    ->groupBy('game_user_infos.id')
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

    public function showTutorial(Request $request)
    {
        $user = GameUserInfo::find($request->userId);

        $user->is_skipped = $request->isSkipped;

        $user->save();

        return response()->json([
            'message' => 'success',
        ],200);
    
    }
}
