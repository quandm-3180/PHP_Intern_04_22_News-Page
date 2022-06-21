<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\PostController as ClientPostController;
use App\Http\Controllers\Client\CommentController as ClientCommentController;
use App\Http\Controllers\Client\UserController as ClientUserController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return redirect()->route('client.home');
});

Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('change-language');

Auth::routes();

Route::name('client.')
    ->group(function () {
        Route::get('/home', [ClientPostController::class, 'homepage'])->name('home');
        Route::get('/category/{slug}', [ClientPostController::class, 'getPostbyCategory'])->name('post-by-category');
        Route::get('/category/{categorySlug}/post/{postSlug}', [ClientPostController::class, 'postDetails'])
            ->name('post-details');
        Route::get('post/search', [ClientPostController::class, 'searchPost'])->name('post.search');
        Route::post('comment/{postId}', [ClientCommentController::class, 'store'])->name('comment.store');
        Route::get('user/profile', [ClientUserController::class, 'index'])->name('user.index');
        Route::get('user/profile/edit', [ClientUserController::class, 'edit'])->name('user.edit');
        Route::post('user/profile/edit', [ClientUserController::class, 'update'])->name('user.update');
    });

Route::prefix('admin')
    ->name('admin.')
    ->middleware('check-admin')
    ->group(function () {
        Route::resource('category', AdminCategoryController::class);
        Route::resource('post', AdminPostController::class);
        Route::get('/post/preview/{slug}', [AdminPostController::class, 'previewPost'])->name('post.preview');
        Route::get('/post-status', [AdminPostController::class, 'postStatus'])->name('post.post-status');
        Route::post('/change-post-status/{id}/{postStatus}', [AdminPostController::class, 'changePostStatus'])
            ->name('post.change-status');
        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::post('user/change-status/{id}/{userStatus}', [UserController::class, 'changeUserStatus'])
            ->name('user.change-status');
    });
