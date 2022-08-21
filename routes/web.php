<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
//Tipo
use App\Http\Livewire\Type\TypeCreate;
use App\Http\Livewire\Type\TypeDashboard;
use App\Http\Livewire\Type\TypeUpdate;
//Vendedor
use App\Http\Livewire\Seller\SellerCreate;
use App\Http\Livewire\Seller\SellerDashboard;
use App\Http\Livewire\Seller\SellerUpdate;
//Ciudad
use App\Http\Livewire\City\CityCreate;
use App\Http\Livewire\City\CityDashboard;
use App\Http\Livewire\City\CityUpdate;
//Producto
use App\Http\Livewire\Product\ProductCreate;
use App\Http\Livewire\Product\ProductDashboard;
use App\Http\Livewire\Product\ProductUpdate;
//Meta
use App\Http\Livewire\Goal\GoalCreate;
use App\Http\Livewire\Goal\GoalDashboard;
use App\Http\Livewire\Goal\GoalUpdate;
//Meta
use App\Http\Livewire\Client\ClientCreate;
use App\Http\Livewire\Client\ClientDashboard;
use App\Http\Livewire\Client\ClientUpdate;
//Ruta
use App\Http\Livewire\Route\RouteCreate;
use App\Http\Livewire\Route\RouteDashboard;
use App\Http\Livewire\Route\RouteUpdate;
//detallevendedor
use App\Http\Livewire\Detailseller\DetailsellerCreate;
use App\Http\Livewire\Detailseller\DetailsellerDashboard;
use App\Http\Livewire\Detailseller\DetailsellerUpdate;
//Ususario
use App\Http\Livewire\User\UserCreate;
use App\Http\Livewire\User\UserDashboard;
use App\Http\Livewire\User\UserUpdate;
//lote
use App\Http\Livewire\Batch\BatchCreate;
use App\Http\Livewire\Batch\BatchDashboard;
use App\Http\Livewire\Batch\BatchUpdate;
//note
use App\Http\Livewire\Note\NoteCreate;
use App\Http\Livewire\Note\NoteDashboard;
use App\Http\Livewire\Note\NoteInformation;
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





Route::group(['middleware' => ['auth:sanctum', 'verified', 'language'], 'prefix' => 'dashboard'], function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    //tipo
    Route::get('type', TypeDashboard::class)->name('type.dashboard')->middleware('auth', 'role:admin|user');
    Route::get('type-create', TypeCreate::class)->name('type.create')->middleware('auth', 'role:admin|user');
    Route::get('type-update/{slug}', TypeUpdate::class)->name('type.update')->middleware('auth', 'role:admin|user');
    //vendedor
    Route::get('seller', SellerDashboard::class)->name('seller.dashboard')->middleware('auth', 'role:admin|user');
    Route::get('seller-create', SellerCreate::class)->name('seller.create')->middleware('auth', 'role:admin|user');
    Route::get('seller-update/{slug}', SellerUpdate::class)->name('seller.update')->middleware('auth', 'role:admin|user');
     //ciudad
    Route::get('city', CityDashboard::class)->name('city.dashboard')->middleware('auth', 'role:admin|user');
    Route::get('city-create', CityCreate::class)->name('city.create')->middleware('auth', 'role:admin|user');
    Route::get('city-update/{slug}', CityUpdate::class)->name('city.update')->middleware('auth', 'role:admin|user');
      //producto
    Route::get('product', ProductDashboard::class)->name('product.dashboard')->middleware('auth', 'role:admin|user');
    Route::get('product-create', ProductCreate::class)->name('product.create')->middleware('auth', 'role:admin|user');
    Route::get('product-update/{slug}', ProductUpdate::class)->name('product.update')->middleware('auth', 'role:admin|user');
      //meta
    Route::get('goal', GoalDashboard::class)->name('goal.dashboard')->middleware('auth', 'role:admin');
    Route::get('goal-create', GoalCreate::class)->name('goal.create')->middleware('auth', 'role:admin');
    Route::get('goal-update/{slug}', GoalUpdate::class)->name('goal.update')->middleware('auth', 'role:admin');
    //cliente
    Route::get('client', ClientDashboard::class)->name('client.dashboard')->middleware('auth', 'role:admin|user');
    Route::get('client-create', ClientCreate::class)->name('client.create')->middleware('auth', 'role:admin|user');
    Route::get('client-update/{slug}', ClientUpdate::class)->name('client.update')->middleware('auth', 'role:admin|user');
    //rutas
    Route::get('route', RouteDashboard::class)->name('route.dashboard')->middleware('auth', 'role:admin|user');
    Route::get('route-create', RouteCreate::class)->name('route.create')->middleware('auth', 'role:admin|user');
    Route::get('route-update/{slug}', RouteUpdate::class)->name('route.update')->middleware('auth', 'role:admin|user');
    //dellevenddedor
    Route::get('detailseller', DetailsellerDashboard::class)->name('detailseller.dashboard')->middleware('auth', 'role:admin|user');
    Route::get('detailseller-create', DetailsellerCreate::class)->name('detailseller.create')->middleware('auth', 'role:admin|user');
    Route::get('detailseller-update/{slug}', DetailsellerUpdate::class)->name('detailseller.update')->middleware('auth', 'role:admin|user');
    //Admin User
    Route::get('user', UserDashboard::class)->name('user.dashboard')->middleware('auth', 'role:admin');
    Route::get('user-create', UserCreate::class)->name('user.create')->middleware('auth', 'role:admin');
    Route::get('user-update/{id}', UserUpdate::class)->name('user.update')->middleware('auth', 'role:admin');
    //lote
    //Admin Batch
    Route::get('batch', BatchDashboard::class)->name('batch.dashboard')->middleware('auth', 'role:admin|user');
    Route::get('batch-create', BatchCreate::class)->name('batch.create')->middleware('auth', 'role:admin|user');
    Route::get('batch-update/{slug}', BatchUpdate::class)->name('batch.update')->middleware('auth', 'role:admin|user');
    //Admin User
    Route::get('note', NoteDashboard::class)->name('note.dashboard')->middleware('auth', 'role:admin');
    Route::get('note-create', NoteCreate::class)->name('note.create')->middleware('auth', 'role:admin');
    Route::get('note-information/{slug}', NoteInformation::class)->name('note.information')->middleware('auth', 'role:admin');
    
});

Route::get('/', function () {
    return view('welcome');
});

//Set language
Route::get('/greeting/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'es'])) {
        abort(403, "Lenguaje no disponible.");
    }
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('greeting.lang');
