<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\UserProfile;
use App\PatientProfile;
use App\PatientAccount;
use App\PatientMessage;

class PatientMessageModelTest extends TestCase
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

        $messages = factory(PatientMessage::class)->create(['patient_profiles_id' => $profile->id,
         'patient_accounts_id' => $account->id,
        ]); 

        $this->assertInstanceOf(PatientProfile::class, $messages->patient);
     }

      /**
     * @group unit
     *
     */

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

        $messages = factory(PatientMessage::class)->create(['patient_profiles_id' => $profile->id,
         'patient_accounts_id' => $account->id,
        ]); 

        $this->assertInstanceOf(PatientAccount::class, $messages->account);
     }
}
