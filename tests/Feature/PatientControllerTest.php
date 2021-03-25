<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\UserProfile;
use App\PatientProfile;
use App\PatientAccount;
use App\PatientGuardianProfile;
use App\PatientReport;

class PatientControllerTest extends TestCase
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

    public function testToPatientList()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

        factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        $this->be($user);

        $response = $this->get('/patients');

        $response->assertStatus(200);

        $response->assertViewIs('patients.index');
    }

    public function testToCreateNewPatientPage()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

        factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        $response = $this->get('/patients/create');

        $response->assertStatus(200);

        $response->assertViewIs('patients.create');
    }

    public function testToShowPatientPageValidId()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        $patientProfile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);

        factory(PatientGuardianProfile::class)->create([
            'patient_profiles_id' => $patientProfile->id,
        ]);

        factory(PatientAccount::class)->create(['patient_profiles_id' => $patientProfile->id]);

        $response = $this->get('/patients/'.$patientProfile->id);

        $response->assertStatus(200);

        $response->assertViewIs('patients.show');
    }

    public function testToShowPatientPageInvalidId()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);

        $fakeId = $this->faker->randomNumber(5,true);

        $response = $this->get('/patients/'.$fakeId);

        $response->assertStatus(302);

        $response->assertRedirect('/patients');
    }

    public function testToEditPatientPageValidId()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        $patientProfile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);

        factory(PatientGuardianProfile::class)->create([
            'patient_profiles_id' => $patientProfile->id,
        ]);

        $response = $this->get('/patients/'.$patientProfile->id.'/edit');

        $response->assertStatus(200);

        $response->assertViewIs('patients.edit');
    }

    public function testToEditPatientPageInvalidId()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);

        $fakeId = $this->faker->randomNumber(5,true);

        $response = $this->get('/patients/'.$fakeId.'/edit');

        $response->assertStatus(302);

        $response->assertRedirect('/patients/'.$fakeId);
    }

    public function testCreateNewPatient()
    {
        $user = factory(User::class)->create();

        factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        $this->be($user);

        $response = $this->post('/patients/store',[
            'first_name' => $this->faker->firstName($gender = null),
            'last_name' => $this->faker->lastName(),
            'ic_number'=> '9902330103392',
            'gender' => 'F',
            'age' => $this->faker->numberBetween(7,11),
            'cancer' => '01',
            'gfirst_name' => $this->faker->firstName($gender = null),
            'glast_name' => $this->faker->lastName(),
            'gic_number' => '991203029112',
            'relations' => '01',
            'contact' => '0123456789',
            'address_one' => $this->faker->address(),
            'address_two' => $this->faker->streetAddress(),
            'postcode' => $this->faker->postcode(),
            'state' => '01',
            'city' => $this->faker->city(),
            'username' => $this->faker->userName(),
            'password' => $this->faker->password(),
        ]);

        $response->assertStatus(302);

        $response->assertRedirect('/');
    }

    public function testUpdatePatientValidId()
    {
        $user = factory(User::class)->create();

        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        $patientProfile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);

        factory(PatientGuardianProfile::class)->create([
            'patient_profiles_id' => $patientProfile->id,
        ]);
        
        $response = $this->put('/patients/'.$patientProfile->id,[
            'first_name' => $this->faker->firstName($gender = null),
            'last_name' => $this->faker->lastName(),
            'ic_number'=> '990230103392',
            'gender' => 'F',
            'age' => $this->faker->numberBetween(7,11),
            'cancer' => '01',
            'gfirst_name' => $this->faker->firstName($gender = null),
            'glast_name' => $this->faker->lastName(),
            'gic_number' => '991203029112',
            'relations' => '01',
            'contact' => '0123456789',
            'address_one' => $this->faker->address(),
            'address_two' => $this->faker->streetAddress(),
            'postcode' => $this->faker->postcode(),
            'state' => '01',
            'city' => $this->faker->city()
        ]);

        $response->assertStatus(302);

        $response->assertRedirect('/patients/'.$patientProfile->id);
    }

    public function testUpdatePatientInvalidId()
    {
        $user = factory(User::class)->create();

        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);

        $fakeId = $this->faker->randomNumber(5,true);
        
        $response = $this->put('/patients/'.$fakeId,[
            'first_name' => $this->faker->firstName($gender = null),
            'last_name' => $this->faker->lastName(),
            'ic_number'=> '990230103392',
            'gender' => 'F',
            'age' => $this->faker->numberBetween(7,11),
            'cancer' => '01',
            'gfirst_name' => $this->faker->firstName($gender = null),
            'glast_name' => $this->faker->lastName(),
            'gic_number' => '991203029112',
            'relations' => '01',
            'contact' => '0123456789',
            'address_one' => $this->faker->address(),
            'address_two' => $this->faker->streetAddress(),
            'postcode' => $this->faker->postcode(),
            'state' => '01',
            'city' => $this->faker->city()
        ]);

        $response->assertStatus(302);

        $response->assertRedirect('/patients/'.$fakeId);
    }

    public function testPatientSearchValidSearch()
    {
        $user = factory(User::class)->create();

        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
            'first_name' => 'John'
        ]);

        $this->be($user);

        $response = $this->post('/patients/search',[
            'q' => 'o',
        ]);

        $response->assertStatus(200);

        $response->assertViewIs('patients.index');
    }

    public function testPatientSearchInvalidSearch()
    {
        $user = factory(User::class)->create();

        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);

        factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
            'first_name' => 'John',
            'last_name' => 'jams'
        ]);

        $this->be($user);

        $response = $this->post('/patients/search',[
            'q' => 'c',
        ]);

        $response->assertStatus(302);

        $response->assertRedirect('/patients');
    }

    public function testAnalyseValidId()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        $profile = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);
        $account = factory(PatientAccount::class)->create(['patient_profiles_id' => $profile->id]);

        factory(PatientReport::class)->create(['patient_profiles_id' => $profile->id,
         'patient_accounts_id' => $account->id,
        ]);
        
        $response = $this->get('patients/'.$profile->id.'/analyse');

        $response->assertStatus(200);

        $response->assertViewIs('patients.analyse');
    }

    public function testAnalyseInvalidId()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email,
        ]);
        factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id,
        ]);

        $fakeId = $this->faker->randomNumber(5,true);
        
        $response = $this->get('patients/'.$fakeId.'/analyse');

        $response->assertStatus(302);

        $response->assertRedirect('/');
    }


}
