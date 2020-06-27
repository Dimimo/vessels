<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

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
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, ['name'     => ['required', 'string', 'max:255', 'unique:users'],
                                       'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
                                       'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create(['name'              => $data['name'],
                             'email'             => $data['email'],
                             'password'          => Hash::make($data['password']),
                             'contact_nr'        => isset($data['contact_nr']) ? $data['contact_nr'] : null,
                             'contact_name'      => isset($data['contact_name']) ? $data['contact_name'] : null,
                             'is_super_admin'    => (isset($data['is_super_admin']) && $data['is_super_admin'] = true) ? true : false,
                             'is_admin_admin'    => (isset($data['is__admin']) && $data['is__admin'] = true) ? true : false,
                             'is_statistical'    => (isset($data['is_statistical']) && $data['is_statistical'] = true) ? true : false,
                             'is_editor'         => (isset($data['is_editor']) && $data['is_editor'] = true) ? true : false,
                             'is_port_authority' => (isset($data['is_port_authority']) && $data['is_port_authority'] = true) ? true : false,
                             'is_operator'       => (isset($data['is_operator']) && $data['is_operator'] = true) ? true : false,
                             'is_agent'          => (isset($data['is_agent']) && $data['is_agent'] = true) ? true : false,
                             'is_captain'        => (isset($data['is_captain']) && $data['is_captain'] = true) ? true : false,
        ]);
    }
}
