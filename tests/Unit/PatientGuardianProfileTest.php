<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\UserProfile;
use App\PatientProfile;
use App\PatientGuardianProfile;

class PatientGuardianProfileTest extends TestCase
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

        $guardian = factory(PatientGuardianProfile::class)->create([
            'patient_profiles_id' => $profile->id,
        ]);

        $this->assertInstanceOf(PatientProfile::class, $guardian->patient); 
     }
}
