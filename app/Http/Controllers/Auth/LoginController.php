<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo(){
        switch(Auth::user()->level){
            case 'user':
                $this->redirectTo = '/home';
                return $this->redirectTo;
                break;

            case 'admin':
               $this->redirectTo = '/home';
                return $this->redirectTo;
                break;

            case 'member':
                $this->redirectTo = '/home';
                return $this->redirectTo;
                break;

            case 'umkm':
                $this->redirectTo = '/home';
                return $this->redirectTo;
                break;
            }
        }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
