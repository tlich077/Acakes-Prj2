<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\ProtypeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//REGISTER
Route::get('/register', [AuthController::class,'register'])->name('register');
Route::post('/register', [AuthController::class, 'Registration'])->name('register.action');

//LOGIN
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/login', [AuthController::class, 'customLogin'])->name('login.action');


Route::get('/index', [AuthController::class,'index'])->name('index');



//LOGOUT
Route::get('logout', [AuthController::class, 'logOut'])->name('logout');




//
///product 
// PRODUCT NEW
Route::get('/index', [ProductController::class, 'getNewProducts'])->name('getNewProducts');

//protype
// PROTYPE
//   Route::get('/index', [ProtypeController::class, 'getTypeName'])->name('getTypeName');






Route::get('/protype/{protype}', [ProductController::class, 'showByProtype'])->name('show');

//Loại 
Route::get('/products/type/{type_id}', [ProductController::class, 'showProductsByType'])->name('products.byType');

// searrch 
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// chi tiet
Route::get('/products/{id}', [DetailProductController::class,'detailProduct'])->name('products.show');
