<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MNPController;
use App\Http\Controllers\authentication\LoginController;
use App\Http\Controllers\authentication\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Master\CountryController;
use App\Http\Controllers\Master\UOMController;
use App\Http\Controllers\Master\BrandController;
use App\Http\Controllers\Master\ShelfLifeController;
use App\Http\Controllers\Master\ItemController;
use App\Http\Controllers\Master\AislesController;
use App\Http\Controllers\Master\CustomerController;
use App\Http\Controllers\Master\VendorController;
use App\Http\Controllers\Transaction\IncomingController;
use App\Http\Controllers\Transaction\OutgoingController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Report\HistoryTransactionController;
use App\Http\Controllers\Report\ItemTransactionController;


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

Route::get('/', function(){
    return redirect('/login');
});

// Route::get('/dashboard', function(){
//     return redirect(route('login_page'));
// });

Route::get('/register', [RegisterController::class, 'getIndex'])->name('register_page');
Route::post('/register', [RegisterController::class, 'storeData'])->name('register_data');
Route::get('/register/switch/{locale}', [RegisterController::class, 'switch']);

Route::get('/login', [LoginController::class, 'getIndex'])->name('login_page');
Route::post('/login', [LoginController::class, 'getData'])->name('login_data');
Route::get('/login/switch/{locale}', [LoginController::class, 'switch']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('guest')->group(function(){
    // Route::get('/dashboard', function(){
    //     return redirect(route('login_page'));
    // });
});

Route::middleware('auth')->group(function(){
    // Route::get('/login', function(){
    //     return redirect(route('dashboard'));
    // });
    // Route::get('/register', function(){
    //     return redirect(route('dashboard'));
    // });
    Route::get('/dashboard', [HomeController::class, 'getIndex'])->name('dashboard');
    Route::post('/dashboard/data', [Homecontroller::class, 'getData']);
    Route::get('/dashboard/switch/{locale}', [HomeController::class, 'switch']);
    Route::get('/dashboard/add-new-user', [HomeController::class, 'getAdd']);
    Route::post('/dashboard/add-new-user/save', [HomeController::class, 'saveNewUser']);

    //Master Country
    Route::get('/countries', [CountryController::class, 'getIndex'])->name('countries');
    Route::get('/countries/add', [CountryController::class, 'getAdd']);
    Route::post('/countries/add/save', [CountryController::class, 'save']);
    Route::get('/countries/details/{id}', [CountryController::class, 'getDetail']);
    Route::get('/countries/edit/{id}', [CountryController::class, 'getDetail']);
    Route::post('/countries/edit/{id}/save', [CountryController::class, 'save']);
    Route::delete('/countries/delete', [CountryController::class, 'delete']);

    //Master UOM
    Route::get('/uoms', [UOMController::class, 'getIndex'])->name('uoms');
    Route::get('/uoms/add', [UOMController::class, 'getAdd']);
    Route::post('/uoms/add/save', [UOMController::class, 'save']);
    Route::get('/uoms/details/{id}', [UOMController::class, 'getDetail']);
    Route::get('/uoms/edit/{id}', [UOMController::class, 'getDetail']);
    Route::post('/uoms/edit/{id}/save', [UOMController::class, 'save']);
    Route::delete('/uoms/delete', [UOMController::class, 'delete']);

    //Master Brand
    Route::get('/brands', [BrandController::class, 'getIndex'])->name('brands');
    Route::get('/brands/add', [BrandController::class, 'getAdd']);
    Route::post('brands/add/save', [BrandController::class, 'save']);
    Route::get('brands/details/{id}', [BrandController::class, 'getDetail']);
    Route::get('brands/edit/{id}', [BrandController::class, 'getDetail']);
    Route::post('brands/edit/{id}/save', [BrandController::class, 'save']);
    Route::delete('/brands/delete', [BrandController::class, 'delete']);

    //Master Items
    Route::get('/items', [ItemController::class, 'getIndex'])->name('items');
    Route::get('/items/add', [ItemController::class, 'getAdd']);
    Route::post('/items/add/save', [ItemController::class, 'save']);
    Route::get('/items/details/{id}', [ItemController::class, 'getDetail']);
    Route::get('/items/edit/{id}', [ItemController::class, 'getDetail']);
    Route::post('/items/edit/{id}/save', [ItemController::class, 'save']);
    Route::delete('/items/delete', [ItemController::class, 'delete']);

    Route::get('/items/update-all-stock', [ItemController::class, 'updateAllStock']);

    //Master Aisle
    Route::get('/aisles', [AislesController::class, 'getIndex'])->name('aisles');
    Route::get('/aisles/add', [AislesController::class, 'getAdd']);
    Route::post('/aisles/add/save', [AislesController::class, 'save']);
    Route::get('/aisles/details/{id}', [AislesController::class, 'getDetail']);
    Route::get('/aisles/edit/{id}', [AislesController::class, 'getDetail']);
    Route::post('/aisles/edit/{id}/save', [AislesController::class, 'save']);
    Route::delete('/aisles/delete', [AislesController::class, 'delete']);
    // Route::get('/aisles/search', [AislesController::class, 'searchAisles'])->name('search-aisles');

    //Master Customer
    Route::get('/customers', [CustomerController::class, 'getIndex'])->name('customers');
    Route::get('/customers/add', [CustomerController::class, 'getAdd']);
    Route::post('/customers/add/save', [CustomerController::class, 'save']);
    Route::get('/customers/details/{id}', [CustomerController::class, 'getDetail']);
    Route::get('/customers/edit/{id}', [CustomerController::class, 'getDetail']);
    Route::post('/customers/edit/{id}/save', [CustomerController::class, 'save']);
    Route::delete('/customers/delete', [CustomerController::class, 'delete']);
    Route::get('/customers/check-transaction-no', [CustomerController::class, 'checkTransactionNo']);

    //Master Vendor
    Route::get('/vendors', [VendorController::class, 'getIndex'])->name('vendors');
    Route::get('/vendors/add', [VendorController::class, 'getadd']);
    Route::post('/vendors/add/save', [VendorController::class, 'save']);
    Route::get('/vendors/details/{id}', [VendorController::class, 'getDetail']);
    Route::get('/vendors/edit/{id}', [VendorController::class, 'getDetail']);
    Route::post('/vendors/edit/{id}/save', [VendorController::class, 'save']);
    Route::delete('/vendors/delete', [VendorController::class, 'delete']);
    Route::get('/vendors/check-transaction-no', [VendorController::class, 'checkTransactionNo']);

    //Transaction Incoming
    Route::get('/incomings', [IncomingController::class, 'getIndex'])->name('incomings');
    Route::get('/incomings/add', [IncomingController::class, 'getAdd']);
    Route::post('/incomings/add/save', [IncomingController::class, 'save']);
    Route::get('/incomings/details/{id}', [IncomingController::class, 'getDetail']);
    Route::get('/incomings/edit/{id}', [IncomingController::class, 'getDetail']);
    Route::post('/incomings/edit/{id}/save', [IncomingController::class, 'save']);
    Route::delete('/incomings/delete', [IncomingController::class, 'delete']);
    Route::get('/incomings/check-transaction-no', [IncomingController::class, 'checkTransactionNo']);

    //Transaction Outgoing
    Route::get('/outgoings', [OutgoingController::class, 'getIndex'])->name('outgoings');
    Route::get('/outgoings/add', [OutgoingController::class, 'getAdd']);
    Route::get('/outgoings/check-stock-item', [OutgoingController::class, 'checkStockItem']);
    Route::post('/outgoings/add/save', [OutgoingController::class, 'save']);
    Route::get('/outgoings/details/{id}', [OutgoingController::class, 'getDetail']);
    Route::get('/outgoings/edit/{id}', [OutgoingController::class, 'getDetail']);
    Route::post('/outgoings/edit/{id}/save', [OutgoingController::class, 'save']);
    Route::delete('/outgoings/delete', [OutgoingController::class, 'delete']);
    Route::get('/outgoings/check-transaction-no', [OutgoingController::class, 'checkTransactionNo']);

    // Profile
    Route::get('/profile/edit/{id}', [ProfileController::class, 'getDetail']);
    Route::post('/profile/edit/{id}/save', [ProfileController::class, 'save']);

    // History Transaction
    Route::get('/historytransaction', [HistoryTransactionController::class, 'getHistoryTransaction'])->name('historytransaction');
    Route::get('/historytransaction/search', [HistoryTransactionController::class, 'search']);

    // Item Transaction
    Route::get('/itemtransaction', [ItemTransactionController::class, 'getItemTransaction'])->name('itemtransaction');
    Route::get('/itemtransaction/search', [ItemTransactionController::class, 'search']);

});
