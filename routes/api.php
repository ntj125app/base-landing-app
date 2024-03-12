<?php

use App\Http\Middleware\XssProtection;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/** All API Route should be sanitized with XSS Middleware */
Route::middleware([XssProtection::class])->group(function () {
});
