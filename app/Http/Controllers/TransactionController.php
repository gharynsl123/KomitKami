<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Restok;
use App\Brand;
use App\Instansi;


class TransactionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    function index() {
        $restok = Restok::all();
        return view('transaction.index-transaction', compact('restok'));
    }

    function create() {
        $restok = Restok::all();
        $merek = Brand::all();
        $instansi = Instansi::all();
        return view('transaction.create-transaction', compact('restok', 'merek' ,'instansi'));
    }

    // Fungsi untuk menghasilkan angka acak dan unik
    private function generateRandomNumber($length = 8)
    {
        $characters = '0123456789';
        $randomNumber = '';

        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomNumber;
    }

    public function store(Request $request)
    {
        $dataStore = $request->all();

        // Array untuk menyimpan nomor PO yang sudah digunakan
        $usedNumbers = [];

        // Loop untuk menghasilkan 10 nomor PO
        for ($i = 0; $i < 1; $i++) {
            do {
                // Menghasilkan nomor PO baru
                $randomNumber = $this->generateRandomNumber();

                // Memastikan nomor PO unik
            } while (in_array($randomNumber, $usedNumbers));

            // Menambahkan nomor PO ke array nomor PO yang sudah digunakan
            $usedNumbers[] = $randomNumber;

            // Menyiapkan data untuk disimpan
            $dataStore['nomor_po'] = $randomNumber;
            $dataStore['slug'] = Str::slug($randomNumber);

            // Membuat objek Restok dan menyimpannya ke dalam database
            Restok::create($dataStore);
        }

        return redirect('/transaction')->with('success', 'Transaksi sudah dibuat');
    }

}