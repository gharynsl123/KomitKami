<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Order;

class ArchiveController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $userInstansiId = Auth::user()->id_instansi;

        $order = Order::whereIn('status', ['reject', 'done'])
        ->when(Auth::user()->level == 'Customer', function ($query) use ($userInstansiId) {
            return $query->where('id_instansi', $userInstansiId);
        })
        ->get();
        return view('archive.index-archive', compact('order'));
    }
}
