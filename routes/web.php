<?php
namespace App\Http\Controller;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ChangedOrdersController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\adminReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderManagement;

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



/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
|
*/

Route::get('/delete', [adminController::class , 'deleteMultiple'])->name('multiple_delete');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin', [HomeController::class, 'admin'])->name('admin.home')->middleware('is_admin');

Route::get('/adminprev', [HomeController::class, 'prev'])->name('admin.prev')->middleware('is_admin');

Route::resource('/admin-actions',adminController::class);
Route::post('/change-password/{id}',[adminController::class,'updatePassword'])->name('updatePassword');

Route::get('/', [HomeController::class, 'index']);


/*
|--------------------------------------------------------------------------
| Orders
|--------------------------------------------------------------------------
|
*/

Route::resource('/order-actions',OrderManagement::class);

Route::resource('/order',OrderController::class);

Route::get('/fetchOrderDetails', [HomeController::class , 'fetchOrders'])->name('admin-chart');

Route::get('/fetchAnalytics',[HomeController::class,'fetchAnalytics'])->name('analytics');

Route::get('/edit-order/{id}', [OrderController::class , 'edit'])->name('editOrder');

Route::post('/change/{id}', [OrderController::class , 'updateOrder'])->name('changeOrder');

Route::get('changedOrder/{id}',[OrderController::class,'changedOrder'])->name('viewChangedOrder');

Route::get('deleteOrder/{id}',[OrderController::class,'deleteOrder'])->name('deleteOrder');

Route::get('delete/{id}',[OrderController::class,'delete'])->name('delete');


/*
|--------------------------------------------------------------------------
| Menu
|--------------------------------------------------------------------------
|
*/

Route::get('/fooditems',[adminReportController::class,'foodItems'])->name('admin.foodItems');

Route::get('/display-menu', [OrderController::class , 'showMenuItems'])->name('showMenuItems');

Route::post('/create-menu-item', [OrderController::class , 'createMenuItem'])->name('createMenuItem');

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
|
*/

Route::get('/userhome', [HomeController::class , 'userHome'])->name('userhome');

Route::get('/disabled users', [adminController::class , 'disabledUsers'])->name('disabled-users');

Route::post('/enable-user', [adminController::class , 'enableUser'])->name('enable-user');
Route::get('/profile', function () {
    return view('userBlades/profile');
})->name('profile');
Route::get('/updatePassword/{id}',[adminController::class,'showPasswordPage'])->name('updateUserPassword');
Route::get('/fetchUserAnalytics',[HomeController::class,'fetchUserAnalytics'])->name('userAnalytics');


/*
|--------------------------------------------------------------------------
| Reports
|--------------------------------------------------------------------------
|
*/
Route::get('/report', [adminReportController::class , 'currentMonth'])->name('adminReport');

Route::get('/user-report', [adminReportController::class , 'currentMonth_user'])->name('userReport');

Route::get('/userReport/{id}', [adminReportController::class , 'userReport'])->name('userReportAdmin');

Route::get('/expenditure', [adminReportController::class , 'index'])->name('admin-report');

Route::post('/notify', [ChangedOrdersController::class,'changedOrders'])->name('notify');

/*
|--------------------------------------------------------------------------
| Notifications
|--------------------------------------------------------------------------
|
*/

Route::post('/readNotifications', [ChangedOrdersController::class,'changedOrders'])->name('notify');




/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
|
*/

Auth::routes();

Route::post('/change-password',[adminController::class, 'changePassword'])->name('change-password');

Route::get('/change-pass',[adminController::class,'changePassword'])->name('change_password');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');

Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
