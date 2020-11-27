<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
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




// Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
// Route::get('/article/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
// Route::patch('/article/{article}', [ArticleController::class, 'update'])->name('article.update');
// Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('article.delete');
// Route::post('/article', [ArticleController::class, 'store'])->name('article.store');


// Route::get('/comment/create', [CommentsController::class, 'create'])->name('comment.create');
// Route::get('/comment/{comment}/edit', [CommentsController::class, 'edit'])->name('comment.edit');
// Route::patch('/comment/{comment}', [CommentsController::class, 'update'])->name('comment.update');
// Route::delete('/comment/{comment}', [CommentsController::class, 'destroy'])->name('comment.delete');
// Route::post('/comment', [CommentsController::class, 'store'])->name('comment.store');


// Route::get('/', [HomeController::class, 'index'])->name('article.index');
// Route::get('/article/{article}', [HomeController::class, 'show'])->name('article.show');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
