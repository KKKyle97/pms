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



class PatientAccountModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testHasManyMessages()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        $account = factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        $messages = factory(PatientMessage::class)->create(['patient_profiles_id' => $profile->id,
         'patient_accounts_id' => $account->id,
        ]); 

        $this->assertTrue($profile->messages->contains($messages));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $profile->messages);
    }

    public function testHasManyReport()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        $account = factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        $reports = factory(PatientReport::class)->create(['patient_profiles_id' => $profile->id,
         'patient_accounts_id' => $account->id,
        ]); 

        $this->assertTrue($profile->reports->contains($reports));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $profile->reports);
    }

    public function testBelongsToPatient()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        $account = factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        $this->assertInstanceOf(PatientProfile::class, $account->patient); 
        $this->assertEquals(1, $account->patient->count());
    }

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

        $this->assertInstanceOf(GameUserInfo::class, $account->info); 
        $this->assertEquals(1, $account->info->count());
    }

    public function testBelongsToManyAvatars()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        $account = factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        factory(Avatar::class)->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $account->avatars);
    }

    public function testBelongsToManyBadges()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        $account = factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        factory(Badge::class)->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $account->badges);
    }
}
