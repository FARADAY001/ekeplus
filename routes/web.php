<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\MovieController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\UploadController;

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

Route::get('/', function () {
    //return view('welcome');
    return redirect('/producer/dashboard');
});

Route::get('/admin', function () {
    //return view('welcome');
    return redirect('/admin/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/// Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

    // Category All Route
    Route::controller(CategoryController::class)->group(function(){
    Route::get('/all/category','AllCategory')->name('all.category');
    Route::get('/add/category','AddCategory')->name('add.category');
    Route::post('/store/category','StoreCategory')->name('store.category');
    Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
    Route::post('/update/category','UpdateCategory')->name('update.category');
    Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
    });

    // Country All Route
    Route::controller(CountryController::class)->group(function(){
        Route::get('/all/country','AllCountry')->name('all.country');
        Route::get('/add/country','AddCountry')->name('add.country');
        Route::post('/store/country','StoreCountry')->name('store.country');
        Route::get('/edit/country/{id}','EditCountry')->name('edit.country');
        Route::post('/update/country','UpdateCountry')->name('update.country');
        Route::get('/delete/country/{id}','DeleteCountry')->name('delete.country');
        });

}); // End Admin Group Middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


/// Producer Group Middleware
Route::middleware(['auth', 'roles:producer'])->group(function(){
    Route::get('/producer/dashboard', [ProducerController::class, 'ProducerDashboard'])->name('producer.dashboard');

    Route::get('/producer/logout', [ProducerController::class, 'ProducerLogout'])->name('producer.logout');

    Route::get('/producer/profile', [ProducerController::class, 'ProducerProfile'])->name('producer.profile');

    Route::post('/producer/profile/store', [ProducerController::class, 'ProducerProfileStore'])->name('producer.profile.store');

    Route::get('/producer/change/password', [ProducerController::class, 'ProducerChangePassword'])->name('producer.change.password');

    Route::post('/producer/password/update', [ProducerController::class, 'ProducerPasswordUpdate'])->name('producer.password.update');


    // producer All Route
    Route::controller(MovieController::class)->group(function(){
        Route::get('/all/movie','AllMovie')->name('all.movie');
        Route::get('/add/movie','AddMovie')->name('add.movie');
        Route::post('/store/movie','StoreMovie')->name('store.movie');
    });

    // test
    Route::controller(UploadController::class)->group(function(){
        Route::get('/add/up','AddUp')->name('add.up');
        Route::post('/store/up','storeUp')->name('store.up');

    });




});

Route::get('upload', [UploadController::class, 'index'])->name('upload.index');
Route::post('upload', [UploadController::class, 'store'])->name('upload.store');

Route::get('/producer/login', [ProducerController::class, 'ProducerLogin'])->name('producer.login');

