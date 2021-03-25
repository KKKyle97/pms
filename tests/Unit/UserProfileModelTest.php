<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\PatientProfile;
use App\User;
use App\UserProfile;

class UserProfileModelTest extends TestCase
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

    public function testBelongsToUser()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        $this->assertInstanceOf(User::class,$userProfile->user);
    }

     /**
     * @group unit
     *
     */

    public function testHasManyPatients()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);

        $this->assertTrue($userProfile->patients->contains($profile));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $userProfile->patients);
    }
}
