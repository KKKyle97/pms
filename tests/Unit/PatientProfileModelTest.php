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
use App\PatientGuardianProfile;

class PatientProfileModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

      /**
     * @group unit
     *
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

     /**
     * @group unit
     *
     */

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

     /**
     * @group unit
     *
     */

    public function testHasOneAccount()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        $this->assertInstanceOf(PatientAccount::class, $profile->account); 
        $this->assertEquals(1, $profile->account->count());
    }

     /**
     * @group unit
     *
     */

    public function testHasOneGuardian()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);

        factory(PatientGuardianProfile::class)->create([
            'patient_profiles_id' => $profile->id,
        ]);

        $this->assertInstanceOf(PatientGuardianProfile::class, $profile->guardian); 
        $this->assertEquals(1, $profile->guardian->count());
    }

     /**
     * @group unit
     *
     */

    public function testBelongsToUser()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);

        $this->assertInstanceOf(UserProfile::class, $profile->user);
    }
}
