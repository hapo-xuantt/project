<?php


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('members')->name('members.')->group(function () {
    Route::get('/', 'MemberController@index')->name('index');
    Route::get('create', 'MemberController@create')->name('create');
    Route::post('/', 'MemberController@store')->name('store');
    Route::get('{member}', 'MemberController@show')->name('show');
    Route::get('{member}/edit', 'MemberController@edit')->name('edit');
    Route::put('{member}', 'MemberController@update')->name('update');
    Route::delete('{member}', 'MemberController@destroy')->name('destroy');
});

Route::prefix('customers')->name('customers.')->group(function () {
    Route::get('/', 'CustomerController@index')->name('index');
    Route::get('create', 'CustomerController@create')->name('create');
    Route::post('/', 'CustomerController@store')->name('store');
    Route::get('{customer}', 'CustomerController@show')->name('show');
    Route::get('{customer}/edit', 'CustomerController@edit')->name('edit');
    Route::put('{customer}', 'CustomerController@update')->name('update');
    Route::delete('{customer}', 'CustomerController@destroy')->name('destroy');
});

Route::resource('project_status', 'ProjectStatusController');

Route::resource('task_status', 'TaskStatusController');

Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', 'ProjectController@index')->name('index');
    Route::get('create', 'ProjectController@create')->name('create');
    Route::get('{project}/add', 'ProjectController@add')->name('add');
    Route::post('/', 'ProjectController@store')->name('store');
    Route::put('{project}/{member}/store', 'ProjectController@storeMember')->name('storeMember');
    Route::get('{project}', 'ProjectController@show')->name('show');
    Route::get('{project}/edit', 'ProjectController@edit')->name('edit');
    Route::put('{project}', 'ProjectController@update')->name('update');
    Route::delete('{project}', 'ProjectController@destroy')->name('destroy');
});

Route::resource('project_status', 'ProjectStatusController');

