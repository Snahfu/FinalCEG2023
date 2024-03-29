<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated(Request $request, $user)
    {
        Auth::logoutOtherDevices($request['password']);
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

    public function redirectTo()
    {
        if (Auth::user()->role == "Player") {
            return "/dashboard";
        } else if (Auth::user()->role == "Tool") {
            return "/tools";
        } else if (Auth::user()->role == "Ingredient") {
            return "/ingredients";
        } else if (Auth::user()->role == "AdminBahan") {
            return "/penjualBahanSell";
        } else if (Auth::user()->role == "AdminDowngrade") {
            return "/penjualDowngradeSell";
        } else if (Auth::user()->role == "AdminHint") {
            return "/hint";
        } else if (Auth::user()->role == "DnC") {
            return "/tinkerer";
        } else if (Auth::user()->role == "Bonus") {
            return "/addKoin";
        } else if (Auth::user()->role == "Consultant") {
            return "/minKoin";
        }
    }
}
