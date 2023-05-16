<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\ProtypeController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
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

//chinh sách
Route::get('/policy', [PolicyController::class,'policy'])->name('policy');

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


//rating
Route::post('/products/{product_id}', [RatingController::class, 'store'])->name('ratings.store')->middleware('auth');

// user

Route::get('/admin/user', [UserController::class, 'user'])->name('user');
// hien thi trang add user
Route::get('/admin/user/add', [UserController::class, 'adduser'])->name('adduser');
// action add
Route::post('/admin/user/add1', [UserController::class, 'adduser1'])->name('adduser1');
Route::get('/admin/user/edit/{id}', [UserController::class, 'edituser'])->name('edituser');
Route::post('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('edit');
// action delete
Route::get('/admin/user/delete/{id}', [UserController::class, 'delete'])->name('deleteuser');
Route::get('/admin/user/search', [UserController::class, 'searchUser'])->name('search');