<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
// use Spatie\YamlFrontMatter\YamlFrontMatter;

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
    return view('posts', [
        'posts' => Post::with('category')->get()
    ]);
});

Route::get('posts/{post:slug}', function (Post $post) {
    // Find a post by its slug and pass is to a view called "post"
    return view('post', [
        'post' => $post
    ]);
}); //->where('post', '[A-z_\-]+'); //Обмеження підстановочних символів маршруту //->whereAlpha('post'); - replace regexp [A-z]. Means just lower or uppercase letters

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts
    ]);
});
