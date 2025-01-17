<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\UserProfile;
use App\PatientProfile;
use App\PatientAccount;
use App\GameUserInfo;
use App\PatientMessage;
use App\PatientReport;
use App\Avatar;
use App\Badge;

class GameControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     * @group mobile
     */
     public function testLogin()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();
        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt($password = 'i-love-laravel')
        ]);
        factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
        ]);

        $response = $this->postJson('/api/ninjaspirits/login',[
            'username' => $account->username,
            'password' => $password,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                    'message' => 'logged in'
                 ]);
     }

     /**
     * @group mobile
     *
     */

     public function testLoginUserNotFound()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();
        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt($password = 'i-love-laravel')
        ]);
        factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
        ]);

        $response = $this->postJson('/api/ninjaspirits/login',[
            'username' => $this->faker->userName(),
            'password' => $password,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                    'message' => 'user not found'
                 ]);
     }

     /**
     * @group mobile
     *
     */

     public function testLoginInvalidPassword()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();
        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);
        factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
        ]);

        $response = $this->postJson('/api/ninjaspirits/login',[
            'username' => $account->username,
            'password' => $this->faker->password,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                    'message' => 'incorrect password'
                 ]);
     }

     /**
     * @group mobile
     *
     */

     public function testFirstTimeLogin()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        factory(Avatar::class)->create();
        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt($password = 'i-love-laravel')
        ]);

        $response = $this->postJson('/api/ninjaspirits/login',[
            'username' => $account->username,
            'password' => $password,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                    'message' => 'first time'
                 ]);
     }

     /**
     * @group mobile
     *
     */

     public function testRegisterNewAccount()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar1 = factory(Avatar::class)->create();
        factory(Avatar::class)->create();

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);

        $response = $this->postJson('/api/ninjaspirits/firstLogin',[
            'username' => $account->username,
            'name' => $this->faker->userName(),
            'avatarId' => $avatar1->id,
        ]);

        $response->assertStatus(201)
                ->assertJson([
                    'message' => 'success'
                ]);
     }

     /**
     * @group mobile
     *
     */

     public function testUpdateScore()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();
        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);
        $userInfo = factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
        ]);

        $response = $this->postJson('/api/ninjaspirits/updateScore',[
            'userId' => $userInfo->id,
            'coin' => $this->faker->randomNumber(),
            'highScore' => $this->faker->randomNumber(),
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'success'
        ]);
     }

     /**
     * @group mobile
     *
     */

     public function testGetScore()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();
        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);
        $userInfo = factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
        ]);

        $response = $this->getJson('/api/ninjaspirits/'.$userInfo->id.'/getScore');

        $response->assertStatus(200)->assertJson([
            'message' => 'success'
        ]);
     }

     /**
     * @group mobile
     *
     */

     public function testChangeAvatar()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();
        $avatar2 = factory(Avatar::class)->create();
        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);
        $userInfo = factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
        ]);

        $response = $this->putJson('/api/ninjaspirits/changeAvatar',[
            'userId' => $userInfo->id,
            'avatarId' => $avatar2->id
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'success'
        ]);
     }

     /**
     * @group mobile
     *
     */

     public function testGetAvatars()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();
        factory(Avatar::class)->create();
        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);
        factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
        ]);

        $response = $this->getJson('/api/ninjaspirits/'.$account->id.'/getAvatars');

        $response->assertStatus(200)->assertJson([
            'message' => 'success'
        ]);
     }

     /**
     * @group mobile
     *
     */

     public function testUnlockAvatar()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();
        factory(Avatar::class)->create();
        $avatar3 = factory(Avatar::class)->create([
            'cost' => 200
        ]);
        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt($password = 'i-love-laravel')
        ]);
        $userInfo = factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
            'coin' => 300,
        ]);

        $response = $this->postJson('/api/ninjaspirits/unlockAvatar',[
            'userId' => $userInfo->id,
            'avatarId' => $avatar3->id,
            'accId' => $account->id,
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'success'
        ]);
     }

     /**
     * @group mobile
     *
     */

     public function testUnlockAvatarInsufficientCoin()
     {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();
        factory(Avatar::class)->create();
        $avatar3 = factory(Avatar::class)->create([
            'cost' => 200
        ]);
        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);
        $userInfo = factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
            'coin' => 1,
        ]);

        $response = $this->postJson('/api/ninjaspirits/unlockAvatar',[
            'userId' => $userInfo->id,
            'avatarId' => $avatar3->id,
            'accId' => $account->id,
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'insufficient coin'
        ]);
     }

     /**
     * @group mobile
     *
     */

    public function testUnlockCoinBadgeSuccess()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);
        factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
            'coin' => 20000,
        ]);

        factory(Badge::class)->create([
            'type' => 1,
            'target' => 1
        ]);

        factory(Badge::class)->create([
            'type' => 1,
            'target' => 10
        ]);

        $response = $this->postJson('/api/ninjaspirits/unlockCoinBadge',[
            'accId' => $account->id,
            'coin' => 10000,
        ]);

        $response->assertStatus(201)->assertJson([
            'message' => 'success'
        ]);
    }

    /**
     * @group mobile
     *
     */

    public function testNoCoinBadgeToUnlock()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);
        factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
            'coin' => 20000,
        ]);

        factory(Badge::class)->create([
            'type' => 1,
            'target' => 1
        ]);

        factory(Badge::class)->create([
            'type' => 1,
            'target' => 10
        ]);

        $response = $this->postJson('/api/ninjaspirits/unlockCoinBadge',[
            'accId' => $account->id,
            'coin' => 0,
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'no badges'
        ]);
    }

    /**
     * @group mobile
     *
     */

    public function testUnlockReportBadgeSuccess()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);

        factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
            'coin' => 20000,
        ]);

        factory(PatientReport::class)->create([
            'patient_accounts_id' => $account->id,
            'patient_profiles_id' => $patient->id,
        ]);

        factory(Badge::class)->create([
            'type' => 2,
            'target' => 1
        ]);

        $response = $this->postJson('/api/ninjaspirits/unlockReportBadge',[
            'accId' => $account->id
        ]);

        $response->assertStatus(201)->assertJson([
            'message' => 'success'
        ]);
    }

    /**
     * @group mobile
     *
     */

    public function testNoReportBadgeToUnlock()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);

        factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
            'coin' => 20000,
        ]);

        factory(PatientReport::class)->create([
            'patient_accounts_id' => $account->id,
            'patient_profiles_id' => $patient->id,
        ]);

        factory(Badge::class)->create([
            'type' => 2,
            'target' => 3
        ]);

        $response = $this->postJson('/api/ninjaspirits/unlockReportBadge',[
            'accId' => $account->id
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'no badges'
        ]);
    }

    /**
     * @group mobile
     *
     */

    public function testUnlockAvatarBadgeSuccess()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar1 = factory(Avatar::class)->create();
        factory(Avatar::class)->create();

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);

        factory(Badge::class)->create([
            'type' => 3,
            'target' => 1
        ]);

        $this->postJson('/api/ninjaspirits/firstLogin',[
            'username' => $account->username,
            'name' => $this->faker->userName(),
            'avatarId' => $avatar1->id,
        ]);

        $response = $this->postJson('/api/ninjaspirits/unlockAvatarBadge',[
            'accId' => $account->id
        ]);

        $response->assertStatus(201)->assertJson([
            'message' => 'success'
        ]);
    }

    /**
     * @group mobile
     *
     */

    public function testNoAvatarBadgeToUnlock()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar1 = factory(Avatar::class)->create();

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);

        factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar1->id,
        ]);

        factory(Badge::class)->create([
            'type' => 3,
            'target' => 3
        ]);

        $response = $this->postJson('/api/ninjaspirits/unlockAvatarBadge',[
            'accId' => $account->id
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'no badges'
        ]);
    }

    /**
     * @group mobile
     *
     */

    public function testGetAllBadges()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);

        $badge = factory(Badge::class)->create();

        $account->badges()->attach($badge->id);

        $response = $this->getJson('/api/ninjaspirits/'.$account->id.'/getAllBadges');

        $response->assertStatus(200)->assertJson([
            'message' => 'success'
        ]);
    }

    /**
     * @group mobile
     *
     */

    public function testSendReport()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar = factory(Avatar::class)->create();

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);

        factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar->id,
            'coin' => 20000,
        ]);

        $response = $this->postJson('/api/ninjaspirits/sendReport',[
            'accId' => $account->id,
            'bodyPart' => $this->faker->word(),
            'level' => $this->faker->randomDigit(),
            'description' => $this->faker->word(),
            'duration' => $this->faker->randomDigit(),
            'mood' => $this->faker->randomDigit(),
        ]);

        $response->assertStatus(201)->assertJson([
            'message' => 'success'
        ]);
    }

    /**
     * @group mobile
     *
     */

    public function testSendMessage()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);

        $response = $this->postJson('/api/ninjaspirits/sendMessage',[
            'accId' => $account->id,
            'message' => $this->faker->sentence(),
            'score' => $this->faker->randomNumber(),
        ]);

        $response->assertStatus(201)->assertJson([
            'message' => 'success'
        ]);
    }

    /**
     * @group mobile
     *
     */

    public function testLoadProfileValidId()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar1 = factory(Avatar::class)->create();

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);

        $userInfo = factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar1->id,
        ]);

        $response = $this->getJson('/api/ninjaspirits/'.$userInfo->id.'/loadProfile');

        $response->assertStatus(200)->assertJson([
            'message' => 'success'
        ]);
    }

    /**
     * @group mobile
     *
     */

    public function testLoadProfileInvalidId()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar1 = factory(Avatar::class)->create();

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);

        factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar1->id,
        ]);

        $response = $this->getJson('/api/ninjaspirits/'.$this->faker->randomNumber(5,true).'/loadProfile');

        $response->assertStatus(200)->assertJson([
            'message' => 'user not found'
        ]);
    }

    /**
     * @group mobile
     *
     */

    public function testShowTutorial()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'email' => $user->email
        ]);
        $patient = factory(PatientProfile::class)->create([
            'user_profiles_id' => $userProfile->id
        ]);
        $avatar1 = factory(Avatar::class)->create();

        $account = factory(PatientAccount::class)->create([
            'patient_profiles_id' => $patient->id,
            'password' => bcrypt('i-love-laravel')
        ]);

        $userInfo = factory(GameUserInfo::class)->create([
            'patient_accounts_id' => $account->id,
            'avatars_id' => $avatar1->id,
        ]);

        $response = $this->putJson('/api/ninjaspirits/showTutorial',[
            'userId' => $userInfo->id,
            'isSkipped' => $this->faker->numberBetween(0,1),
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'success'
        ]);
    }
}
