<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormulaController extends Controller
{
    function index() {
        return view('formula.index-formula');
    }
}
