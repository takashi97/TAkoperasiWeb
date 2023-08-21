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
        $messages = [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.unique' => 'Email sudah terpakai, silahkan menggunakan email lainnya.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.confirmed' => 'Password tidak sama dengan konfirmasi password',
            'password.min' => 'Password tidak boleh kurang :min karakter.',
            'n_telepon.required' => 'Nomor telepon tidak boleh kosong.',                        
            'n_telepon.regex' => 'Format pengisian:+6212345678901.',
            'n_telepon.unique' => 'Nomor telepon sudah terpakai, silahkan menggunakan nomor telepon lainnya.',
            't_lahir.required' => 'Tanggal lahir harus diisi.',
            'j_kelamin.required' => 'Jenis kelamin harus diisi.',
            // add more custom messages here
        ];
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'n_telepon' => ['required', 'regex:/^\+[0-9]{11,14}$/'],
            't_lahir' => ['required', 'date'],
            'j_kelamin' => ['required', 'in:male,female', 'string'],
        ], $messages

    );
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'n_telepon' => $data['n_telepon'],
            't_lahir' => $data['t_lahir'],
            'j_kelamin' => $data['j_kelamin'],
        ]);
        return $user;

    }
    
    
    
    
}