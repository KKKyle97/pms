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

class PatientProfileModelTest extends TestCase
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
}
