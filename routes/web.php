<?php


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth:member']], function (){

    Route::resource('members', 'MemberController');

    Route::resource('customers', 'CustomerController');

    Route::resource('project_status', 'ProjectStatusController');

    Route::resource('task_status', 'TaskStatusController');

    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', 'ProjectController@index')->name('index');
        Route::get('create', 'ProjectController@create')->name('create');
        Route::get('{project}/add', 'ProjectController@add')->name('add');
        Route::post('/', 'ProjectController@store')->name('store');
        Route::post('{project}/{member}/store', 'ProjectController@storeMember')->name('store_member');
        Route::delete('{project}/{member}', 'ProjectController@destroyMember')->name('destroy_member');
        Route::get('{project}', 'ProjectController@show')->name('show');
        Route::get('{project}/edit', 'ProjectController@edit')->name('edit');
        Route::patch('{project}', 'ProjectController@update')->name('update');
        Route::delete('{project}', 'ProjectController@destroy')->name('destroy');
    });

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', 'TaskController@index')->name('index');
        Route::get('create', 'TaskController@create')->name('create');
        Route::post('/', 'TaskController@store')->name('store');
        Route::get('{project}/add', 'TaskController@add')->name('add');
        Route::get('{task}', 'TaskController@show')->name('show');
        Route::get('{task}/edit', 'TaskController@edit')->name('edit');
        Route::patch('{task}', 'TaskController@update')->name('update');
        Route::patch('{task}/assign', 'TaskController@assign')->name('assign');
        Route::delete('{task}', 'TaskController@destroy')->name('destroy');
        Route::get('show_member_project/{id}','TaskController@showMemberProject')->name('show_member_project');
    });
});


