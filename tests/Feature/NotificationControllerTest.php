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

class NotificationControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /**
     * @group web
     *
     */
    protected function SetUp(): void
    {
        parent::setUp();
        $user = factory(User::class)->create();
        $this->be($user);
    }

    /**
     * @group web
     *
     */

    public function testToNotificationListIndex()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        $account = factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        factory(PatientMessage::class)->create(['patient_profiles_id' => $profile->id,
         'patient_accounts_id' => $account->id,
        ]);

        $this->be($user);

        $response = $this->get('/notifications');

        $response->assertStatus(200);

        $response->assertViewIs('notifications.index');
    }

    /**
     * @group web
     *
     */
    
    public function testShowNotificationDetailInvalidId()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

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

        $response = $this->get('/notifications/'.$this->faker->randomDigitNot($messages->id));

        $response->assertStatus(302);

        $response->assertRedirect('/');
    }

    /**
     * @group web
     *
     */

    public function testUpdateNotificationDetailValidId()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

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


        $response = $this->put('/notifications/'.$messages->id,[
            'solution' => $this->faker->sentence(),
        ]);

        $response->assertStatus(200);
    }

    /**
     * @group web
     *
     */

    public function testUpdateNotificationDetailInvalidId()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        $account = factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        factory(PatientMessage::class)->create(['patient_profiles_id' => $profile->id,
         'patient_accounts_id' => $account->id,
        ]);

        $fakeId = $this->faker->randomNumber(5,true);

        $response = $this->put('/notifications/'.$fakeId,[
            'solution' => $this->faker->sentence(),
        ]);

        $response->assertStatus(302);

        $response->assertRedirect('/notifications/');
    }
}
