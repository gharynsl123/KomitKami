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

        return redirect('user-configuration')->with('success', 'User Berhasil di buat');
    }

    function detail($id)  {
        $user = User::find($id);
        return view('user.detail-user', compact('user'));
    }
    function edit($id)  {
        $user = User::find($id);
        $instansi = Instansi::all();
        return view('user.edit-user', compact('user', 'instansi'));
    }

    function update(Request $request, $id) {
        $user = User::find($id);
        $dataUpdate = $request->all();
    
        if ($request->filled('password')) {
            $dataUpdate['password'] = bcrypt($request->password);
            $dataUpdate['view_pass'] = $request->password;
        } else {
            // If password is not provided in the request, use the existing values
            $dataUpdate['password'] = $user->password;
            $dataUpdate['view_pass'] = $user->view_pass;
        }
    
        $user->update($dataUpdate);
    

        return redirect('/user-configuration')->with('success', "$user->name Berhasil Di Update");
    }

    function editProfile($id) {
        $user = User::find($id);
        return view('user.edit-profile', compact('user'));
    }
}