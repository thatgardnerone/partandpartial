<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/lazy-cards', function () {
    return Inertia::render('LazyCards');
})->name('lazy-cards');

Route::get('/modal-form', function () {
    return Inertia::render('ModalForm');
})->name('modal-form.index');
