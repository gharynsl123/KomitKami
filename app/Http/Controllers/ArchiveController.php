<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    function index() {
        return view('archive.index-archive');
    }
}
