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
use App\PatientReport;
use App\GameUserInfo;
use App\Avatar;
use App\Badge;


class AvatarModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testHasOneGameUserInfo()
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

        factory(GameUserInfo::class)->create(['avatars_id' => $avatar->id, 'patient_accounts_id' => $account->id]);

        $this->assertInstanceOf(GameUserInfo::class, $avatar->info);
    }

    public function testBelongsToManyAccounts()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        $avatar = factory(Avatar::class)->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $avatar->users);
    }

}
