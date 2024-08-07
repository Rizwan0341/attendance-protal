<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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

        $html = '<p>Your Login Detail is  : Email: <span>'.$data['email'].'</span></p><br>';
        $html .= '<p>Password: <span>'.$data['password'].'</span></p><br>';
        $html .= '<p>Portal URL: <span>'.route('home').'</span></p><br>';
        $email = [
            'email' =>  $data['email'],
            'details' => [
                'heading' => 'Login Your Attendance Portal and Mark Your Attendance',
                'content' =>  $html,
                'WebsiteName' => 'Attendance'
            ]

 

        ];

        $datamail = Mail::send('mail.user_email', $email, function ($message) use ($email) {
            $message->to($email['email'])->subject($email['details']['heading']);
        });


        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => intval($data['role']),
            'user_shift' => intval($data['select_shift']),
        ]);


    }
}
