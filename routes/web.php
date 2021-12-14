<?php
namespace App\Http\Controller;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\adminReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\OrderController;





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

Route::resource('/admin-actions',adminController::class);

//route to the crud operations on orders

Route::resource('/order',OrderController::class);
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [HomeController::class, 'admin'])->name('admin.home')->middleware('is_admin');

//Auth::routes();

//Route::get('/report', [App\Http\Controllers\adminControllers\adminReportController::class, 'currentMonth'])->name('adminReport');
Route::get('/report', [adminReportController::class , 'currentMonth'])->name('adminReport');

Route::get('/foodItemsAdmin',[adminReportController::class,'foodItems'])->name('admin.foodItems');

Route::get('/delete', [adminController::class , 'deleteMultiple'])->name('multiple_delete');