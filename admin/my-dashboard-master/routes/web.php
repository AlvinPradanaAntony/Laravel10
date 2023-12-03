<?php

use Illuminate\Support\Facades\Route;;
use App\Http\Controllers\Usr\HomeController;
use App\Http\Controllers\Usr\ProfileController;

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

require __DIR__.'/auth/usr.php';

Route::group(['middleware' => ['auth', 'verified']], function () {
    # Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    # Profile
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/profile/set-image', [ProfileController::class, 'setImage'])->name('profile.set.image');
});
