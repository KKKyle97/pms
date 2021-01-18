<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'ic_number' => ['required', 'string', 'min:12','max:12','unique:user_profiles',],
            'contact' => ['required','string', 'min:10', 'max:11',],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'sq_one_q' => ['required'],
            'sq_one_a' => ['required'],
            'sq_two_q' => ['required'],
            'sq_two_a' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $newUser = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'sq_one_q' => $data['sq_one_q'],
            'sq_one_a' => $data['sq_one_a'],
            'sq_two_q' => $data['sq_two_q'],
            'sq_two_a' => $data['sq_two_a'],
        ]);

        $user = User::where('email', $data['email'])->first();

        $user->userProfile()->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'ic_number' => $data['ic_number'],
            'gender' => $data['gender'],
            'contact' => $data['contact'],
            'role' => $data['role'],
            'hospital_code' => $data['hospital']
        ]);

        return $newUser;
    }
}
