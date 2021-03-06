<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\PatientProfile;
use App\PatientMessage;
use App\User;
use App\UserProfile;
use App\PatientAccount;
use App\GameUserInfo;
use App\Avatar;

class GameUserInfoModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testBelongsToAvatar()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        $account = factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        $avatar = factory(Avatar::class)->create();

        $gameInfo = factory(GameUserInfo::class)->create(['avatars_id' => $avatar->id, 'patient_accounts_id' => $account->id]);

        $this->assertInstanceOf(Avatar::class, $gameInfo->avatar);
    }

    public function testBelongsToAccount()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        $account = factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        $avatar = factory(Avatar::class)->create();

        $gameInfo = factory(GameUserInfo::class)->create(['avatars_id' => $avatar->id, 'patient_accounts_id' => $account->id]);

        $this->assertInstanceOf(PatientAccount::class, $gameInfo->account);
     }
}
