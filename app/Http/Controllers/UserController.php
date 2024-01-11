<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Instansi;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $user = User::all();
        return view('user.index-user', compact('user'));
    }

    function profile($id) {
        $user = User::find($id);
        return view('user.profile-user', compact('user'));
    }
    function create() {
        $user = User::all();
        $instansi = Instansi::all();
        return view('user.create-user', compact('user', 'instansi'));
    }
}
