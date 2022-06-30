<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



/* 
Route::get('posts', function(){

    $posts = Post::all();

    return response()->json([
        'status_code' => 200,
        'status_text' => 'Success',
        'name' => 'Gianluca',
        'posts' => $posts,
    ]);
}); 
*/


/* 
Route::get('posts', function () {

    $posts = Post::all();

    return $posts;
}); 
*/

/*
Route::get('posts', function () {

    $posts = Post::paginate(); 

    return $posts;
}); 
*/


/* 
Route::get('posts', function () {

    $posts = Post::with(['tags', 'category', 'user'])->get(); 

    return $posts;
}); 
*/


/* Route::get('posts', function () {

    $posts = Post::with(['tags', 'category', 'user'])->orderByDesc('id')->paginate(5); 

    return $posts; 

}); */

Route::get('posts', 'API\PostController@index');
Route::get('categories', 'API\CategoryController@index');
Route::get('tags', 'API\TagController@index');


