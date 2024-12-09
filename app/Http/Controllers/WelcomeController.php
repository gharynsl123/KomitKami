<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class WelcomeController extends Controller
{
    public function landingPage() {
        return view('guest.beranda');
    }

    public function companyProfile() {
        $images = Image::all();
        return view('guest.profile-company', compact('images'));
    }
}
