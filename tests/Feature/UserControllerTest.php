<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\User;
use App\UserProfile;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
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
    
    public function testToShowUserProfile()
    {
        $user = factory(User::class)->create();
        factory(UserProfile::class)->create([
            'email' => $user->email
        ]);

        $response = $this->get('/users/'.$user->id);

        $response->assertStatus(200);
        $response->assertViewIs('users.show');
    }

    /**
     * @group web
     *
     */

    public function testToShowUserProfileInvalidId()
    {
        
        factory(User::class)->create();

        $response = $this->get('/users/'.$this->faker->randomNumber(5,true));

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    /**
     * @group web
     *
     */

    public function testToEditUserProfile()
    {
        $user = factory(User::class)->create();
        factory(UserProfile::class)->create([
            'email' => $user->email
        ]);

        $response = $this->get('/users/'.$user->id.'/edit');

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
    }

    /**
     * @group web
     *
     */

    public function testToEditUserProfileInvalidId()
    {
        $user = factory(User::class)->create();

        factory(UserProfile::class)->create([
            'email' => $user->email
        ]);

        $fakeId = $this->faker->randomNumber(5,true);

        $response = $this->get('/users/'.$fakeId.'/edit');

        $response->assertStatus(302);
        $response->assertRedirect('/users/'.$fakeId);
    }

    /**
     * @group web
     *
     */

    public function testUpdateUserProfileValid()
    {
        $user = factory(User::class)->create();
        $profile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);

        $response = $this->put('/users/'.$profile->id,[
            'first_name' => $this->faker->firstName($gender = null),
            'last_name' => $this->faker->lastName(),
            'ic_number' => '990292023390',
            'gender' => 'F',
            'contact' => '0123456789',
            'role' => '01',
            'hospital_code' => 'J002',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/users/'.$profile->id);
    }

    /**
     * @group web
     *
     */

    public function testUpdateUserProfileInvalidId()
    {
        $user = factory(User::class)->create();
        factory(UserProfile::class)->create([
            'email' => $user->email
        ]);

        $fakeId = $this->faker->randomNumber(5,true);

        $response = $this->put('/users/'.$fakeId,[
            'first_name' => $this->faker->firstName($gender = null),
            'last_name' => $this->faker->lastName(),
            'ic_number' => '990292023390',
            'gender' => 'F',
            'contact' => '0123456789',
            'role' => '01',
            'hospital_code' => 'J002',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/users/'.$fakeId);
    }
}
