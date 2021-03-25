<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\UserProfile;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */

     public function testHasOneUserProfile()
     {
        $user = factory(User::class)->create();
        factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        $this->assertInstanceOf(UserProfile::class,$user->userProfile);
     }

}
