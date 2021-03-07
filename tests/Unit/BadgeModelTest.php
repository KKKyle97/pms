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


class BadgeModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testBelongsToManyAccounts()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        $account = factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        $badge = factory(Badge::class)->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $badge->users);
    }

}
