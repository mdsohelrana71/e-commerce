<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
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
Route::get('/products', [FrontendController::class, 'products'])->name('products');
Route::get('/product-details/{slug}', [FrontendController::class, 'productDetails'])->name('product.details');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog-details/{slug}', [BlogController::class, 'blogDetails'])->name('blog.details');
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
Route::middleware('admin.auth')->prefix('admin')->group(function (){

    // task routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::get('/task-add', [TaskController::class, 'taskAdd'])->name('task.add');
    Route::post('/tasks-store', [TaskController::class, 'taskStore'])->name('task.store');
    Route::get('/task.details', [TaskController::class, 'taskDetails'])->name('task.details');
    Route::post('/tasks-status-change', [TaskController::class, 'taskStatusChange'])->name('task.status.change');
    Route::delete('/tasks-destroy', [TaskController::class, 'taskDestroy'])->name('task.destroy');

    // shop profile routes
    Route::get('/shop-profile', [ProfileController::class, 'shopProfile'])->name('shop.profile');
    Route::post('/shop-profile-update', [ProfileController::class, 'shopProfileUpdate'])->name('shop.profile.update');
    Route::get('/shop-icon', [ProfileController::class, 'shopIcon'])->name('shop.icon');

    // blog routes
    Route::get('/blogs/{status?}', [BlogController::class, 'index'])->name('blogs');
    Route::get('/blog-create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog-store/{id?}', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog-destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::get('/blog-edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::get('/blogs-export/{type}', [BlogController::class, 'blogExport'])->name('blogs.export');
    Route::get('/blogs-search', [BlogController::class, 'blogSearch'])->name('blogs.search');
    Route::get('/blogs-settings', [BlogController::class, 'blogSettings'])->name('blogs.settings');

    // product routes
    Route::get('/products/{status?}', [ProductController::class, 'index'])->name('products');
    Route::get('/product-create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product-store/{id?}', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product-destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product-edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/products-search', [ProductController::class, 'productSearch'])->name('products.search');
    Route::get('/product-settings', [ProductController::class, 'productSettings'])->name('product.settings');

    // category routes
    Route::get('/category/{status?}', [CategoryController::class, 'index'])->name('category');
    Route::get('/category-create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category-store/{id?}', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category-destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/category-search', [CategoryController::class, 'categorySearch'])->name('category.search');


});

// Admin all routes End

require __DIR__.'/auth.php';
