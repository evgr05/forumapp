<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Главная
Route::get('/', [HomeController::class, 'index'])->name('home');

// Просмотр хештегов и постов
Route::get('/blog/category/{id?}', [BlogController::class, 'category'])->name('category');
Route::get('/blog/post/{id?}', [BlogController::class, 'post'])->name('post');
Route::get('/blog/posts', [PostController::class, 'index'])->name('posts');

// Админка
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', [StatsController::class, 'index'])->name('admin.index');
    Route::resource('/category', CategoryController::class, ['as' => 'admin']);
    Route::resource('/post', PostController::class, ['as' => 'admin']);
});

// Роуты для авторизации/регистрации/и т.д.
Auth::routes();

// Сюда переадресовывает после регистрации и/или авторизации
// При этом переадресация прописана в /vendor/laravel/framework/src/Illuminate/Foundation/Auth/RedirectsUsers.php
// И нет возможности её изменить. Печаль
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
