<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LPController;
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
Route::get('/', [LPController::class, 'homepage'])->name('homepage');

Route::get('/login', [LoginController::class, 'loginPage'])->name('loginPage');
Route::get('/register', [LoginController::class, 'registerPage'])->name('registerPage');

Route::post('/register-process',  [LoginController::class, 'registerProcess'])->name('registerProcess');
Route::post('/login-process',  [LoginController::class, 'loginProcess'])->name('loginProcess');

Route::group(['middleware'=> 'login'],function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboardPage'])->name('dashboardPage');
Route::get('/dashboard/resto', [DashboardController::class, 'dashboardRestoPage'])->name('dashboardRestoPage');

    Route::get('/add-restaurant', [DashboardController::class, 'addRestaurantPage'])->name('addRestaurantPage');
    Route::post('/add-restaurant-process', [DashboardController::class, 'addRestaurantProcess'])->name('addRestaurantProcess');
    
    // Schedule
    Route::get('/add-schedule', [DashboardController::class, 'addSchedulePage'])->name('addSchedulePage');
    Route::post('/add-schedule-process', [DashboardController::class, 'addScheduleProcess'])->name('addScheduleProcess');

});
