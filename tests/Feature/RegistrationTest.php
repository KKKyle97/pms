<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\UserProfile;
use App\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testToRegistrationPage()
    {
        $response = $this->get('/register');
        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    public function testRegisterNewUserAccount()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/register',[
            'first_name' => $this->faker->firstName($gender = null),
            'last_name' => $this->faker->lastName(),
            'ic_number' => '990292023390',
            'gender' => 'F',
            'contact' => '0123456789',
            'role' => '01',
            'email' => $this->faker->email(),
            'hospital' => 'J002',
            'password' => 'ilovelaravelasdsad',
            'password_confirmation' => 'ilovelaravelasdsad',
            'sq_one_q' => '01',
            'sq_one_a' => $this->faker->sentence(),
            'sq_two_q' => '01',
            'sq_two_a' => $this->faker->sentence(),
        ]);

        $response->assertStatus(302);

        $this->assertTrue(count(UserProfile::all()) > 0);
    }
}
