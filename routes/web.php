<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\authentication\LoginController;
use App\Http\Controllers\authentication\RegisterController;
use App\Http\Controllers\Master\UOMController;
use App\Http\Controllers\Master\CountryController;
use App\Http\Controllers\Master\ShelfLifeController;
use App\Http\Controllers\Master\ItemController;
use App\Http\Controllers\Master\AislesController;
use App\Http\Controllers\Master\VendorController;
use App\Http\Controllers\HomeController;

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

// Route::get('/register', [RegisterController::class, 'getIndex'])->name('register_page');
// Route::post('/register', [RegisterController::class, 'storeData'])->name('register_data');

Route::get('/login', [LoginController::class, 'getIndex'])->name('login_page');
Route::post('/login', [LoginController::class, 'getData'])->name('login_data');
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

    //Master UOM
    Route::get('/uoms', [UOMController::class, 'getIndex'])->name('uoms');
    Route::get('/uoms/add', [UOMController::class, 'getAddUOMs'])->name('add-uoms');
    Route::post('/uoms/add', [UOMController::class, 'saveUOMs']);
    Route::get('/uoms/edit/{id}', [UOMController::class, 'getDetailUOMs'])->name('edit-uoms');
    Route::post('/uoms/edit', [UOMController::class, 'editUOM']);
    Route::delete('/uoms/delete', [UOMController::class, 'deleteUOM']);
    Route::get('/uoms/search', [UOMController::class, 'searchUOM'])->name('search-uoms');

    //Master Country
    Route::get('/countries', [CountryController::class, 'getIndex'])->name('countries');
    Route::get('/countries/add', [CountryController::class, 'getAddCountries'])->name('add-countries');
    Route::post('/countries/add', [CountryController::class, 'saveCountries']);
    Route::get('/countries/edit/{id}', [CountryController::class, 'getDetailCountries'])->name('edit-countries');
    Route::post('/countries/edit', [CountryController::class, 'editCountry']);
    Route::delete('/countries/delete', [CountryController::class, 'deleteCountries']);
    Route::get('/countries/search', [CountryController::class, 'searchCountries'])->name('search-countries');

    //Master Shelf Life
    Route::get('/shelflife', [ShelfLifeController::class, 'getIndex'])->name('shelflife');
    Route::get('/shelflife/add', [ShelfLifeController::class, 'getAddShelflife'])->name('add-shelflife');
    route::get('/shelflife/search', [ShelflifeController::class, 'searchShelflife'])->name('search-shelflife');

    //Master Items
    Route::get('/items', [ItemController::class, 'getIndex'])->name('items');
    Route::get('/items/add', [ItemController::class, 'getAddItems'])->name('add-items');
    Route::post('/items/add', [ItemController::class, 'saveItems']);
    Route::get('/items/edit/{id}', [ItemController::class, 'getDetailItems'])->name('edit-items');
    Route::get('/items/search', [ItemController::class, 'searchItems'])->name('search-items');

    //Master Aisle
    Route::get('/aisles', [AislesController::class, 'getIndex'])->name('aisles');
    Route::get('/aisles/add', [AislesController::class, 'getAddAisles'])->name('add-aisles');
    Route::post('/aisles/add', [AislesController::class, 'saveAisles']);
    Route::get('/aisles/edit/{id}', [AislesController::class, 'getDetailAisles'])->name('edit-aisles');
    Route::post('/aisles/edit', [AislesController::class, 'editAisles']);
    Route::delete('/aisles/delete', [AislesController::class, 'deleteAisles']);
    Route::get('/aisles/search', [AislesController::class, 'searchAisles'])->name('search-aisles');

    //MasterVendor
    Route::get('/vendors', [VendorController::class, 'getIndex'])->name('vendors');
    Route::get('/vendors/add', [VendorController::class, 'getaddVendors'])->name('add-vendors');
    Route::post('/vendors/add', [VendorController::class, 'saveVendors']);

    //Transaction Incoming
    Route::get('/incoming', [IncomingController::class, 'getIndex'])->name('incoming');
    Route::get('/incoming/add', [IncomingController::class, 'getAddIncoming'])->name('add-incoming');
});
