<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
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

// Route::get('/', function () {
//     return view('welcome');
// });



// Route untuk yang belum login
Route::middleware(['guest'])->group(function(){
    
    Route::get('login',[UserController::class,'index_login'])->name('login');
    Route::post('login_process',[UserController::class,'login_process'])->name('login_process');
    
    Route::get('register',[UserController::class,'register'])->name('register');
    Route::post('register_process',[UserController::class,'register_process'])->name('register_process');

});



// Route untuk yang sudah login
Route::middleware(['auth'])->group(function(){

    Route::get('/home',[HomeController::class,'index'])->name('/home');

    Route::get('logout',[UserController::class,'logout'])->name('logout');

    Route::resource('peminjaman', PeminjamanController::class);

    Route::get('show_user/{id}',[UserController::class,'show_user'])->name('show_user');
   
    
});


Route::group(['middleware'=>['auth','cekLevel:admin']], function(){

    Route::get('employee',[EmployeeController::class,'index'])->name('employee');
    Route::get('create_employee',[EmployeeController::class,'create']);
    Route::post('store_employee',[EmployeeController::class,'store']);
    Route::get('edit_employee/{id}',[EmployeeController::class,'edit']);
    Route::patch('update_employee/{id}',[EmployeeController::class,'update']);
    Route::delete('delete_employee/{id}',[EmployeeController::class,'destroy']);

    Route::resource('category', CategoryController::class);
    Route::resource('book', BookController::class);

    Route::get('user',[UserController::class,'index_user'])->name('user');
    Route::post('store_user',[UserController::class,'store_user'])->name('store_user');
    Route::patch('update_user/{id}',[UserController::class,'update_user'])->name('update_user');
    Route::delete('delete_user/{id}',[UserController::class,'destroy_user'])->name('delete_user');
    
   


});


Route::group(['middleware'=>['auth','cekLevel:staff,admin']], function(){

    Route::resource('entry', EntryController::class);
    Route::resource('pengembalian', PengembalianController::class);

});

// Route::group(['middleware'=>['auth','ceklevel:anggota,staff,admin']], function(){

   
    
// });