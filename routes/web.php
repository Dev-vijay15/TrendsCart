<?php

use App\Http\Controllers\backend\productController;
use App\Http\Controllers\backend\brandController;
use App\Http\Controllers\backend\permission\permissionController;
use App\Http\Controllers\backend\auth\adminAuthController;
use App\Http\Controllers\backend\dashboardController;
use App\Http\Controllers\frontend\userAuthController;
use App\Http\Controllers\backend\permission\roleController;
use App\Http\Controllers\backend\usersController;
use App\Http\Controllers\frontend\homeController;
use Illuminate\Support\Facades\Route;

//customer Routes 
Route::get('/', function () {
    return redirect('/home');  // Redirect to /home
});

Route::get('/home', function () {
    return view('frontend.index');  // Load the homepage
});

Route::group(['prefix' => 'account'], function () {

    // Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [userAuthController::class, 'showLoginForm'])->name('users.login');
    Route::get('/register', [userAuthController::class, 'showRegisterForm'])->name('users.RegisterForm');
    Route::post('/users/login', [userAuthController::class, 'login'])->name('login');
    Route::post('/userRegister', [userAuthController::class, 'Register'])->name('users.register');
    // });
});

Route::group(['prefix' => 'users'], function () {

    Route::middleware(['auth', 'user'])->group(function () {
        Route::get('/logout', [userAuthController::class, 'logout'])->name('logout');
        Route::get('/home', [homeController::class, 'index'])->name('frontend.index');
    });
});


// backend routes 

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [adminAuthController::class, 'LoginForm'])->name('admin.login');
     Route::get('/register', [adminAuthController::class, 'showRegisterForm'])->name('admin.registerForm');
    Route::post('/login/account', [adminAuthController::class, 'adminLogin'])->name('adminLogin');
     Route::post('/userRegister', [adminAuthController::class, 'Register'])->name('admin.register');

     Route::middleware(['auth:admin', 'admin'])->group(function () {

        route::get('/logout', [adminAuthController::class, 'logout'])->name('admin.logout');
        route::get('/dashboard', [dashboardController::class, 'dashboard'])->name('admin.dashboard');

        // Admin Routes
        route::get('/permission/list', [permissionController::class, 'index'])->name('permission.list');
        route::get('/Permission/create', [permissionController::class, 'create'])->name('permission.create');
        route::post('/Permission/store', [permissionController::class, 'store'])->name('permission.store');
        Route::get('/permission/show/{id}', [PermissionController::class, 'show'])->name('permission.show');
        route::get('/Permission/edit/{id}', [permissionController::class, 'edit'])->name('permission.edit');
        Route::put('permissions/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
        Route::delete('permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');

        route::get('/role/list', [roleController::class, 'index'])->name('role.list');
        route::get('/role/create', [roleController::class, 'create'])->name('role.create');
        route::post('/role/store', [roleController::class, 'store'])->name('role.store');
        Route::get('/role/show/{id}', [roleController::class, 'show'])->name('role.show');
        route::get('/role/edit/{id}', [roleController::class, 'edit'])->name('role.edit');
        Route::put('roles/update/{id}', [roleController::class, 'update'])->name('role.update');
        Route::delete('roles/delete/{id}', [roleController::class, 'destroy'])->name('role.destroy');

        route::get('/users/list', [usersController::class, 'index'])->name('users.list');
        route::get('/users/create', [usersController::class, 'create'])->name('users.create');
        route::post('/users/store', [usersController::class, 'store'])->name('users.store');
        Route::get('/users/show/{id}', [usersController::class, 'show'])->name('users.show');
        route::get('/users/edit/{id}', [usersController::class, 'edit'])->name('users.edit');
        Route::put('userss/update/{id}', [usersController::class, 'update'])->name('users.update');
        Route::delete('userss/delete/{id}', [usersController::class, 'destroy'])->name('users.destroy');

        route::get('/brands/list', [brandController::class, 'index'])->name('brands.list');
        route::get('/brands/create', [brandController::class, 'create'])->name('brands.create');
        route::post('/brands/store', [brandController::class, 'store'])->name('brands.store');
        Route::get('/brands/show/{id}', [brandController::class, 'show'])->name('brands.show');
        route::get('/brands/edit/{id}', [brandController::class, 'edit'])->name('brands.edit');
        Route::put('brands/update/{id}', [brandController::class, 'update'])->name('brands.update');
        Route::delete('brands/delete/{id}', [brandController::class, 'destroy'])->name('brands.destroy');

        route::get('/products/list', [productController::class, 'index'])->name('products.list');
        route::get('/products/create', [productController::class, 'create'])->name('products.create');
        route::post('/products/store', [productController::class, 'store'])->name('products.store');
        Route::get('/products/show/{id}', [productController::class, 'show'])->name('products.show');
        route::get('/products/edit/{id}', [productController::class, 'edit'])->name('products.edit');
        Route::put('products/update/{id}', [productController::class, 'update'])->name('products.update');
        Route::delete('productss/delete/{id}', [productController::class, 'destroy'])->name('products.destroy');

        
    });
});
