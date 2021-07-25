<?php
use Illuminate\Support\Facades\Route;
//books
Route::group(['prefix' => 'book'], function (){
    Route::get('/list', 'App\Http\Controllers\Api\V1\Book\Index@listBook')->name('book_list');
    Route::post('/store', 'App\Http\Controllers\Api\V1\Book\Store@storeBook')->name('book_store');
    Route::put('/update/{id}', 'App\Http\Controllers\Api\V1\Book\Update@changeAuthor')
        ->name('book_update');
    Route::delete('/delete/{id}', 'App\Http\Controllers\Api\V1\Book\Delete@destroyBook')
        ->name('book_delete');
    Route::post('/search', 'App\Http\Controllers\Api\V1\Book\Search@searchBook')->name('book_search');
    Route::get('/export', 'App\Http\Controllers\Api\V1\Book\Export@exportBook')->name('book_export');
});

