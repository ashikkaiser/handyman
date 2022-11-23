<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required'],
            'post_code' => ['string',],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'phone' => $data['phone'],
            'post_code' => $data['post_code'],
        ]);
        // if ($user) {
        //     $details = [
        //         'user' => $user,
        //         'title' => 'New User Registration',
        //         'body' => "A new user $user->name has signup as a user",
        //         'subject' => 'New User Registration',
        //     ];
        //     $detailsUser = [
        //         'user' => $user,
        //         'title' => 'Thank you for registering',
        //         'body' => "Welcome to the community $user->name . We are glad to have you on board and we are looking forward to working with you. Thank you for choosing us.",
        //         'subject' => 'New User Registration',
        //     ];

        //     $userx = User::where('role', 'admin')->first();
        //     dispatch(new \App\Jobs\RegistrationNotification($userx, $details));
        //     dispatch(new \App\Jobs\RegistrationNotification($user, $detailsUser));
        // }
        return  $user;
    }
}
