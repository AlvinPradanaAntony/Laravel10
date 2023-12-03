<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;

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

require __DIR__.'/auth/admin.php';

Route::group(['middleware' => ['auth:admin,admin', 'verified'], 'prefix' => 'admin'], function () {
    # Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    # Profile
    Route::get('/profile', [HomeController::class, 'profile'])->name('admin.profile');
    Route::post('/profile/set-image', [ProfileController::class, 'setImage'])->name('admin.profile.set.image');
});

