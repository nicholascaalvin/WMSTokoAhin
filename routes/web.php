<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

    //Master Country
    Route::get('/countries', [CountryController::class, 'getIndex'])->name('countries');
    Route::get('/countries/add', [CountryController::class, 'getAdd']);
    Route::post('/countries/add/save', [CountryController::class, 'save']);
    Route::get('/countries/details/{id}', [CountryController::class, 'getDetail']);
    Route::get('/countries/edit/{id}', [CountryController::class, 'getDetail']);
    Route::post('/countries/edit/{id}/save', [CountryController::class, 'save']);
    Route::get('/countries/delete', [CountryController::class, 'delete']);
    // Route::get('/countries/search', [CountryController::class, 'searchCountries'])->name('search-countries');

    //Master UOM
    Route::get('/uoms', [UOMController::class, 'getIndex'])->name('uoms');
    Route::get('/uoms/add', [UOMController::class, 'getAdd']);
    Route::post('/uoms/add/save', [UOMController::class, 'save']);
    Route::get('/uoms/details/{id}', [UOMController::class, 'getDetail']);
    Route::get('/uoms/edit/{id}', [UOMController::class, 'getDetail']);
    Route::post('/uoms/edit/{id}/save', [UOMController::class, 'save']);
    Route::delete('/uoms/delete', [UOMController::class, 'delete']);
    // Route::get('/uoms/search', [UOMController::class, 'searchUOM'])->name('search-uoms');

    //Master Brand
    Route::get('/brands', [BrandController::class, 'getIndex'])->name('brands');
    Route::get('/brands/add', [BrandController::class, 'getAdd']);
    Route::post('brands/add/save', [BrandController::class, 'save']);
    // Route::get('brands/edit/{id}', [BrandController::class, 'getDetailBrands'])->name('edit-brands');
    // Route::post('brands/edit', [BrandController::class, 'editBrands']);
    Route::delete('/brands/delete', [BrandController::class, 'delete']);
    // route::get('/brands/search', [BrandController::class, 'searchBrands'])->name('search-brands');

    //Master Shelf Life
    Route::get('/shelflifes', [ShelfLifeController::class, 'getIndex'])->name('shelflifes');
    Route::get('/shelflifes/add', [ShelfLifeController::class, 'getAdd']);
    Route::post('/shelflifes/add/save', [ShelfLifeController::class, 'save']);
    Route::delete('/shelflifes/delete', [ShelfLifeController::class, 'delete']);
    // route::get('/shelflifes/search', [ShelflifeController::class, 'searchShelflifes'])->name('search-shelflifes');

    //Master Items
    Route::get('/items', [ItemController::class, 'getIndex'])->name('items');
    Route::get('/items/add', [ItemController::class, 'getAdd']);
    Route::post('/items/add/save', [ItemController::class, 'save']);
    Route::get('/items/details/{id}', [ItemController::class, 'getDetail']);
    Route::get('/items/edit/{id}', [ItemController::class, 'getDetail']);
    Route::post('/items/edit/{id}/save', [ItemController::class, 'save']);
    // Route::get('/items/edit/{id}', [ItemController::class, 'getDetailItems'])->name('edit-items');
    Route::delete('/items/delete', [ItemController::class, 'delete']);
    // Route::get('/items/search', [ItemController::class, 'searchItems'])->name('search-items');

    //Master Aisle
    Route::get('/aisles', [AislesController::class, 'getIndex'])->name('aisles');
    Route::get('/aisles/add', [AislesController::class, 'getAdd']);
    Route::post('/aisles/add/save', [AislesController::class, 'save']);
    // Route::get('/aisles/edit/{id}', [AislesController::class, 'getDetailAisles'])->name('edit-aisles');
    // Route::post('/aisles/edit', [AislesController::class, 'editAisles']);
    Route::delete('/aisles/delete', [AislesController::class, 'delete']);
    // Route::get('/aisles/search', [AislesController::class, 'searchAisles'])->name('search-aisles');

    //Master Customer
    Route::get('/customers', [CustomerController::class, 'getIndex'])->name('customers');
    Route::get('/customers/add', [CustomerController::class, 'getAdd']);
    Route::post('/customers/add/save', [CustomerController::class, 'save']);

    //MasterVendor
    Route::get('/vendors', [VendorController::class, 'getIndex'])->name('vendors');
    Route::get('/vendors/add', [VendorController::class, 'getadd']);
    Route::post('/vendors/add/save', [VendorController::class, 'save']);
    Route::delete('/vendors/delete', [VendorController::class, 'delete']);

    //Transaction Incoming
    Route::get('/incomings', [IncomingController::class, 'getIndex'])->name('incomings');
    Route::get('/incomings/add', [IncomingController::class, 'getAdd']);
    Route::post('/incomings/add/save', [IncomingController::class, 'save']);
    Route::get('/incomings/details/{id}', [IncomingController::class, 'getDetail']);
    Route::get('/incomings/edit/{id}', [IncomingController::class, 'getDetail']);
    Route::post('/incomings/edit/{id}/save', [IncomingController::class, 'save']);
});
