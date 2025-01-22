<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected function redirectTo()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah level user adalah 'production spv'
        if ($user->level == 'production spv') {
            return '/ruang-produksi';
        }
        if ($user->level == 'Inventory Manager') {
            return '/permintaan-material';
        }
        if ($user->level == 'Supervisor') {
            return '/ruang-produksi';
        }

        // Default redirect untuk user lain
        return '/dashboard';
    }

    public function username()
    {
        return 'username';
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
