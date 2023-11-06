<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/service', [FrontendController::class, 'service'])->name('service');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

Route::get('/dashboard', function (){
    return view('admin/dashboard');
})->middleware('admin.auth')->name('dashboard');

Route::middleware('auth')->group(function (){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/password-change', [ProfileController::class, 'passwordChange'])->name('password.change');
    Route::get('/user-profile', [ProfileController::class, 'edit'])->name('user.profile');
});

Route::middleware('admin.auth')->group(function (){
    Route::get('/shop-profile', [ProfileController::class, 'shopProfile'])->name('shop.profile');
});

require __DIR__.'/auth.php';
