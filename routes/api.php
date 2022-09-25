<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController as ApiPostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [ApiAuthController::class, 'login']);
    Route::post('/register', [ApiAuthController::class, 'register']);
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::post('/refresh', [ApiAuthController::class, 'refresh']);
    Route::get('/user-profile', [ApiAuthController::class, 'userProfile']);
});

Route::get('social/login', [ApiAuthController::class, 'socialLogin']);

Route::get('/posts', [ApiPostController::class, 'index'])->middleware(['auth:api']);
Route::get('/posts/details', [ApiPostController::class, 'AllPostsDetails'])->middleware(['auth:api']);
Route::get('/post/{id}', [ApiPostController::class, 'show']);
Route::post('/post/create', [ApiPostController::class, 'store']);
Route::post('/post/update/{id}', [ApiPostController::class, 'update']);
Route::post('/post/delete/{id}', [ApiPostController::class, 'destroy']);
Route::get('/post/details/{id}', [ApiPostController::class, 'userPosts'])->middleware(['auth:api']);
// comment Route
Route::post('post/comment_create', [ApiPostController::class, 'storeComment'])->middleware(['auth:api']);;
Route::post('post/comment_update/{id}', [ApiPostController::class, 'updateComment'])->middleware(['auth:api']);;
Route::post('post/comment_delete/{id}', [ApiPostController::class, 'deleteComment'])->middleware(['auth:api']);;

Route::get('/post/comment/{id}', [ApiPostController::class, 'commentPost'])->middleware(['auth:api']);
Route::get('/posts/category', [ApiPostController::class, 'postsCategory']);
Route::get('/posts/{category}', [ApiPostController::class, 'postsIdCategory']);



// Like Route

Route::post('/post/like', [ApiPostController::class, 'likersAction']);
Route::post('/post/like_remove/{id}', [ApiPostController::class, 'deleteLike'])->middleware(['auth:api']);;
//
