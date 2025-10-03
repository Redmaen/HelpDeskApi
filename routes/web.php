<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cliente/register', [AuthController::class, 'viewRegister'])->name('register.view');

Route::get('/admin/register', [AuthController::class, 'viewRegisterAdmin'])->name('registeradmin.view');

Route::get('/ti/register', [AuthController::class, 'viewRegisterTecnicoTI'])->name('registerTI.view');

Route::get('/insitu/register', [AuthController::class, 'viewRegisterTecnicoInSitu'])->name('registerInSitu.view');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '^(?!api).*$');
