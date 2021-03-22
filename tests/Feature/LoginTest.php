<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // protected function SetUp(): void
    // {
    //     parent::setUp();
    //     $user = factory(User::class)->create();
    //     $this->be($user);
    // }
    
    public function testToLoginPage()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testCannotGoBackToLoginPageIfAuthenticated()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/');
    }

    public function testLoginWithCorrectCredential()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function testLoginWithIncorrectCredential()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'abcd',
        ]);

        $response->assertRedirect('/');
    }
}
