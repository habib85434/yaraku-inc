<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'book'], function (){
    Route::get('/list', 'App\Http\Controllers\Api\V1\Book\Index@bookList')->name('book_list');
    Route::post('/store', 'App\Http\Controllers\Api\V1\Book\Store@bookStore')->name('book_store');
    Route::put('/update/{id}', 'App\Http\Controllers\Api\V1\Book\Update@changeAuthor')
        ->name('book_update');
    Route::delete('/delete/{id}', 'App\Http\Controllers\Api\V1\Book\Delete@destroy')
        ->name('book_delete');

});

