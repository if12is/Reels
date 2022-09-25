<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    return view('welcome');
});


// Google routes for your application.
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('facebook')->user();

//     // OAuth 2.0 providers...
//     $token = $user->token;
//     $refreshToken = $user->refreshToken;
//     $expiresIn = $user->expiresIn;

//     // OAuth 1.0 providers...
//     $token = $user->token;
//     $tokenSecret = $user->tokenSecret;

//     // All providers...
//     $user->getId();
//     $user->getNickname();
//     $user->getName();
//     $user->getEmail();
//     $user->getAvatar();

//     $user = Socialite::driver('github')->userFromToken($token);
// });

// Facebook routes for your application.
Route::get('auth/facebook', [FacebookController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [FacebookController::class, 'loginWithFacebook']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
