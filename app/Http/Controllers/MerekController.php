<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class MerekController extends Controller
{
    function index() {
        return view('brands.index-brand');
    }
}
