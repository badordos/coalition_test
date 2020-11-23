<?php


Route::middleware('api')->prefix('/v1/')->group(function () {
    Route::get('/books/search', 'BookController@search');
    Route::apiResource('/books', 'BookController');
    Route::get('/authors/search', 'AuthorController@search');
    Route::apiResource('/authors', 'AuthorController');
});
