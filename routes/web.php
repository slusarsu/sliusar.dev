<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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
Route::get('/post-search', [PostController::class, 'search'])->name('post-search');

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('posts', [PostController::class, 'index'])->name('posts');
Route::get('posts/{slug}', [PostController::class, 'show'])->name('post');

Route::get('tags', [TagController::class, 'index'])->name('tags');
Route::get('tags/{slug}', [TagController::class, 'show'])->name('tag');

Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::get('categories/{slug}', [CategoryController::class, 'show'])->name('category');

Route::get('{slug}', [PageController::class, 'show'])->name('page');
