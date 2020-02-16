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

    // =====   CONTACTS   =====
    // Browse
    Route::get('contacts', 'ContactController@index')->name('contacts.index');
    Route::get('contacts/datatable', 'ContactController@datatable')->name('contacts.datatable');
    // Add
    Route::get('contacts/create', 'ContactController@create')->name('contacts.create');
    Route::post('contacts/create', 'ContactController@store')->name('contacts.store');
    // Read / Redirect To Edit
    Route::get('contacts/{id}', 'ContactController@edit');
    // Edit
    Route::get('contacts/{id}/edit', 'ContactController@edit')->name('contacts.edit');
    Route::patch('contacts/{id}', 'ContactController@update')->name('contacts.update');
    // Delete
    Route::delete('contacts/{id}', 'ContactController@destroy')->name('contacts.destroy');

    // =====   Journal   =====
    // Browse
    Route::get('journals', 'JournalController@index')->name('journals.index');
    Route::get('journals/datatable', 'JournalController@datatable')->name('journals.datatable');
    // Add
    Route::get('journals/create', 'JournalController@create')->name('journals.create');
    Route::post('journals/create', 'JournalController@store')->name('journals.store');
    // Read / Redirect To Edit
    Route::get('journals/{id}', 'JournalController@edit');
    // Edit
    Route::get('journals/{id}/edit', 'JournalController@edit')->name('journals.edit');
    Route::patch('journals/{id}', 'JournalController@update')->name('journals.update');
    // Delete
    Route::delete('journals/{id}', 'JournalController@destroy')->name('journals.destroy');


    // Get cities from state_id
    Route::post('states/cities', 'StateController@getCities')->name('states.cities');

});
