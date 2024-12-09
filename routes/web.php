<?php

use App\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Exports\MonthlyPurchasesExport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

|
*/

Auth::routes(['register' => false]);

Route::get('lang/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/download-excel', function () {
    $monthlyPurchases = [];

    $months = [
        'January', 'February', 'March', 'April', 'May', 'June', 
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    $productNames = Order::select('product.name')
        ->join('product', 'order.product_id', '=', 'product.id')
        ->where('order.id_user', Auth::user()->id)
        ->groupBy('product.name')
        ->pluck('product.name');

    foreach ($productNames as $productName) {
        $monthlyPurchases[$productName] = [];
        foreach ($months as $month) {
            $quantity = Order::selectRaw('SUM(order.quantity) AS total_quantity')
                ->join('product', 'order.product_id', '=', 'product.id')
                ->where('order.id_user', Auth::user()->id)
                ->where('product.name', $productName)
                ->whereMonth('order.created_at', Carbon::parse($month)->month)
                ->value('total_quantity');
            
            $monthlyPurchases[$productName][$month] = $quantity ?: 0;
        }
    }

    return Excel::download(new MonthlyPurchasesExport($monthlyPurchases, $months), 'Pembelian Barang Report.xlsx');
})->name('download.excel');


Route::get('/fetch-purchases-by-year', 'HomeController@fetchPurchasesByYear');

// User Route
Route::post('/store-user', 'UserController@store');
Route::get('/create-user', 'UserController@create');
Route::get('/edit-profile/{id}', 'UserController@editProfile');
Route::get('/edit-user/{id}', 'UserController@edit');
Route::put('/update-user/{id}', 'UserController@update');
Route::get('/user-configuration', 'UserController@index');
Route::get('/profile-user', 'UserController@profile');
Route::delete('/delete-user/{id}', 'UserController@delete');

// Dashboar Route
Route::get('/', 'WelcomeController@landingPage');
Route::get('/profile-perusahaan', 'WelcomeController@companyProfile');
Route::get('/dashboard', 'HomeController@index');
Route::get('/preview-data/charts', 'HomeController@showChartData');


// Transaction Route
Route::get('/transaction/in', 'TransactionController@index');
Route::get('/transaction/out', 'TransactionController@out');
Route::get('/buat-pesanan-restok', 'TransactionController@create');
Route::post('/store-transaction', 'TransactionController@store');
Route::post('/store-out', 'TransactionController@storeOut');
Route::delete('/delete-item/{id}' , 'TransactionController@delete');
Route::get('/get-batch-details' , 'TransactionController@getBatchDetails');

// Ordering Route
Route::get('/view-order', 'OrderController@index');
Route::get('/buat-order', 'OrderController@create');
Route::post('/store-order', 'OrderController@store');
Route::post('/revisi-order', 'OrderController@kirimRevisi');
Route::put('/reject-order/{id}', 'OrderController@reject');
Route::put('/accept-order/{id}', 'OrderController@accept');
Route::put('/change-time/{id}', 'OrderController@changetime');
Route::get('/order-details/{slug}', 'OrderController@detail');
Route::patch('/update-status/{id}', 'OrderController@updateStatus')->name('update-status');

// Inventory Route
Route::get('/local-inventory', 'InventoryController@index');
Route::get('/local-inventory/detail/{slug}', 'InventoryController@detail');
Route::get('/buat-bahan-baku', 'InventoryController@create');
Route::post('/store-bahanbaku', 'InventoryController@store');

// printRoute
route::get('/view-print-po/{slug}', 'PrintController@preorder')->name('po.print');
Route::get('/print-rekap-po', 'PrintController@rekaporder')->name('rekap.print');
Route::get('/print-unpaid-po', 'PrintController@unpaid')->name('unpaid.print');

// PO
Route::get('/catatan-po', 'OrderController@rekapPO')->name('rekap.po');
Route::get('/detail-rekap-po', 'OrderController@detailRekap')->name('rekap.detail');
Route::get('/payment-pre-order', 'OrderController@unpaid');
Route::get('/detail-charts', 'OrderController@detailCharts')->name('detailCharts');

// Produksi Route
Route::get('/ruang-produksi', 'ProduksiController@index');
Route::get('/buat-tikect-produksi', 'ProduksiController@create');
Route::get('/get-last-production-number', 'ProduksiController@getLastProductionNumber');
Route::get('/get-po-items/{po_id}', 'ProduksiController@getPoItems');
Route::post('/store-data-tiket', 'ProduksiController@store');
Route::get('/detail-tiket/{date}',  'ProduksiController@show')->name('detail.tiket');
Route::get('/get-products/{invoice_id}', 'ProduksiController@getProducts');
Route::get('/detail-produksi/{batch_number}', 'ProduksiController@detail');
Route::put('/update-status-produksi/{id}', 'ProduksiController@updateSatusProduksi');
Route::put('/confirm-produksi/{id}', 'ProduksiController@confirmProduksi');

// mulai
Route::get('/mulai-produksi/{batch_number}', 'RuangProduksiController@proses');
Route::get('/riwayat-produksi', 'RuangProduksiController@riwayat');
Route::get('/atur-ruang-produksi', 'RuangProduksiController@index');
Route::post('/store-periksaan-ruangan', 'RuangProduksiController@storeProduksi');
// ruangan set
Route::post('/store-nama-ruangan', 'RuangProduksiController@createRuangan');
Route::post('/store-bagian', 'RuangProduksiController@storeItems');
Route::put('/update-nama-ruangan/{id}', 'RuangProduksiController@update');
Route::delete('/delete-bagian/{id}', 'RuangProduksiController@deleteItem');

// Formulir Permintaan bahan produksi
Route::get('/form-permintaan-material-produksi/{batch_number}', 'RequestMaterialProduksi@create');
Route::post('/permintaan-material/store', 'RequestMaterialProduksi@store')->name('permintaan_material.store');
Route::get('/permintaan-material', 'RequestMaterialProduksi@index');
Route::get('/show-all/permintaan' , 'RequestMaterialProduksi@showAll');

Route::get('/get-formulas-by-batch/{batch_number}', 'TransactionController@getFormulasByBatch');


// ready develerry
Route::get('/barang-siap-kirim', 'DeliveryController@index')->name('delivery.index');
Route::get('/buat-devilery', 'DeliveryController@create');
Route::post('/store-ready-order', 'DeliveryController@store')->name('delivery.storDeliveryControllere');
Route::post('/add-to-list', 'DeliveryController@addToList')->name('delivery.add_to_list');
Route::get('/get-order-items/{invoiceId}', 'DeliveryController@getOrderItems')->name('delivery.get_order_items');
Route::get('/lihat-surat/{No_SJ}', 'DeliveryController@letter')->name('delivery.get_order_items');

// Products Route
Route::get('/products', 'ProductController@index');
Route::get('/create-products', 'ProductController@create');
Route::get('/edit-products/{id}', 'ProductController@edit');
Route::post('/store-products', 'ProductController@store');
Route::put('/update-product/{id}', 'ProductController@update');
Route::delete('/delete-product/{id}', 'ProductController@delete')->name('products.delete');
Route::get('/products/{id}', 'ProductController@show')->name('products.show');


// Merek Route
Route::get('/merek', 'MerekController@index');
Route::post('/store-merek', 'MerekController@store');
Route::get('/edit-merek/{id}', 'MerekController@edit')->name('edit-merek');
Route::put('/update-merek/{id}', 'MerekController@update')->name('update-merek');

// Formula
Route::get('/formula', 'FormulaController@index');
Route::get('/buat-formula-baru', 'FormulaController@create');
Route::get('/detail-formula/{slug}', 'FormulaController@detail')->name('formula.detail');
Route::post('/store-formula', 'FormulaController@store');

// Archive
Route::get('/archive', 'ArchiveController@index');

// Laporan Route
Route::get('/laporan-pesanan/{slug}', 'LaporanController@view');
Route::PUT('/confirm-laporan/{id}', 'LaporanController@confirm');
Route::get('/confirm-revisi/order/{slug}', 'LaporanController@confirmRevision');
Route::put('/orders/{id}', 'LaporanController@updateConfirmation')->name('orders.update');

// chat Route
Route::get('/message', 'ChatController@index');
