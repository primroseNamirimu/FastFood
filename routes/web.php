<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth routes
Route::get('/',function(){
    return view('auth.login');
});

// Route::get('/register',function(){
//     return view('auth.register');
// })->name('register');
// Dashboard route

Route::get('/admin', function () {
    return view('adminBlades/adminHome');
})->name('admin');

/////// profile route //////
Route::get('/profile', function () {
    return view('userBlades/profile');
})->name('profile');


//route to the crud operations on orders

Route::resource('/order', App\Http\Controllers\OrderController::class);
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home')->middleware('is_admin');

//Auth::routes();

Route::get('/report', [App\Http\Controllers\adminControllers\adminReportController::class, 'currentMonth'])->name('adminReport');
