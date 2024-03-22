<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Product;

class InventoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $inventory = Inventory::all();
        return view('inventory.index-inventory', compact('inventory'));
    }
    
    function create() {
        $inventory = Inventory::all();
        $product = Product::all();
        return view('inventory.create-inventory', compact('inventory', 'product'));
    }

    function store(Request $request) {
        $dataStore = $request->all();
        Inventory::create($dataStore);

        return redirect('local-inventory')->with('success', 'bahan baku behasil di tambahkan');
    }

    function detail($id) {
        $inventory = Inventory::find($id);
        return view('inventory.detail-inventory', compact('inventory'));
    }
}
