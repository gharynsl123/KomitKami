<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

    function profile() {
        $user = User::find(Auth::user()->id);
        return view('user.profile-user', compact('user'));
    }
    function create() {
        $user = User::all();
        $instansi = Instansi::all();
        return view('user.create-user', compact('user', 'instansi'));
    }

    function store(Request $req) {
        $dataStore = $req->all();
        $dataStore['password'] = bcrypt($req->password);
        $dataStore['view_pass'] = $req->password;
        User::create($dataStore);

        return redirect('user')->with('success', 'User Berhasil di buat');
    }
}