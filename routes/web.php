<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () { 

    // =====   TAGS   =====
    // Browse
    Route::get('tags', 'TagController@index')->name('tags.index');
    Route::get('tags/datatable', 'TagController@datatable')->name('tags.datatable');
    // Add
    Route::get('tags/create', 'TagController@create')->name('tags.create');
    Route::post('tags/create', 'TagController@store')->name('tags.store');
    // Read / Redirect To Edit
    Route::get('tags/{id}', 'TagController@edit');
    // Edit
    Route::get('tags/{id}/edit', 'TagController@edit')->name('tags.edit');
    Route::patch('tags/{id}', 'TagController@update')->name('tags.update');
    // Delete
    Route::delete('tags/{id}', 'TagController@destroy')->name('tags.destroy');

    
});
