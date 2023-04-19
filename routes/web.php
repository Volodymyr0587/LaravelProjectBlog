<?php

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

Route::get('/', function () {
    return view('posts');
});

Route::get('posts/{post}', function ($slug) {

    if (! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {
        return redirect('/');
        // abort(404);
    }

    $post = cache()->remember("post.{$slug}", 1200, fn() => file_get_contents($path));

    return view('post', ['post' => $post]);
})->where('post', '[A-z_\-]+'); //Обмеження підстановочних символів маршруту //->whereAlpha('post'); - replace regexp [A-z]. Means just lower or uppercase letters
