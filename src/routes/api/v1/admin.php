<?php
use Illuminate\Support\Facades\Route;
//books
Route::group(['prefix' => 'books'], function (){
    Route::get('/', 'App\Http\Controllers\Api\V1\Book\Index@listBook')->name('book_list');
    Route::post('/', 'App\Http\Controllers\Api\V1\Book\Store@storeBook')->name('book_store');
    Route::put('/{id}', 'App\Http\Controllers\Api\V1\Book\Update@changeAuthor')
        ->name('book_update');
    Route::delete('/{id}', 'App\Http\Controllers\Api\V1\Book\Delete@destroyBook')
        ->name('book_delete');
    Route::post('/search', 'App\Http\Controllers\Api\V1\Book\Search@searchBook')->name('book_search');
    Route::post('/export-xml', 'App\Http\Controllers\Api\V1\Book\ExportXML@exportXMLBook')
        ->name('book_export_xml')->middleware('xml');
    Route::post('/export-csv', 'App\Http\Controllers\Api\V1\Book\ExportCSV@exportCSVBook')
        ->name('book_export_csv');
});

