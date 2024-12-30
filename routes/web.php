<?php

use App\Http\Controllers\LandingController;
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

/** Route start here, WEB used for GET only */
Route::get('/sanctum/csrf-cookie', function () {
    return response()->json(['status' => 'success', 'csrf_token' => app()->environment('production') ? 'token' : csrf_token()]);
});

Route::get('/php-ip-detect', function () {
    if (! app()->environment('local')) {
        return response()->json(['status' => 'error', 'message' => 'This feature is only available in local environment.'], 403);
    } else {
        return response()->json(['status' => 'success', 'ip' => request()->ip(), request()->headers->all()]);
    }
});

/** Route for login redirect */
Route::get('/login-redirect', function () {
    return redirect(route('landing-page'));
})->name('login');

Route::get('/', [LandingController::class, 'landingPage'])->name('landing-page');
