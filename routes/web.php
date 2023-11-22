<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TaskController;
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
    Route::get('/user-profile', [ProfileController::class, 'userProfile'])->name('user.profile');
});

// Admin all routes start

Route::middleware('admin.auth')->group(function (){

    // task routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::get('/add-task', [TaskController::class, 'addTask'])->name('add.task');
    Route::post('/store-task', [TaskController::class, 'storeTask'])->name('store.task');

    // shop profile routes
    Route::get('/shop-profile', [ProfileController::class, 'shopProfile'])->name('shop.profile');
    Route::post('/shop-profile-update', [ProfileController::class, 'shopProfileUpdate'])->name('shop.profile.update');

    // blog routes
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
    Route::get('/blogs-settings', [BlogController::class, 'blogSettings'])->name('blogs.settings');

});

// Admin all routes End

require __DIR__.'/auth.php';
