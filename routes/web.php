<?php

use App\Models\Post;
use Illuminate\Http\Request;
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

Route::post('/lazy-cards', function () {
    return to_route('lazy-cards');
})->name('lazy-cards');

Route::get('/modal-form', function () {
    return Inertia::render('ModalForm', [
        'random' => random_int(1, 100),
        'post' => Inertia::lazy(function () {
            return Post::find(2);
        }),
    ]);
})->name('modal-form.index');

Route::post('/modal-form/{post}', function (Request $request, Post $post) {
    $validated = $request->validate([
        'title' => 'required',
        'body'  => 'required',
    ]);

    $post->update($validated);

    return to_route('modal-form.index');
})->name('modal-form.update');
