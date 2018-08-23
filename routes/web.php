<?php

Route::get('/', function () {
    return view('welcome');
});

/** Required middelware Authentification.**/

Route::middleware('auth')->group(function () {

    Route::get('task/comments/{id}', 'TaskController@comments')->name('task.add');
    Route::post('task/{id}/edit', 'TaskController@addComment')->name('task.add.comment');
    Route::delete('task/{id}/edit', 'TaskController@deleteComment')->name('task.delete.comment');
    Route::patch('task/{id}/edit','TaskController@updateComment')->name('task.update.comment');

    Route::resource('task', 'TaskController');

    Route::middleware('admin')->group(function () {

        Route::get('/admin', 'Admin\AdminController@index')->name('admin');
        Route::get('/admin/users', 'Admin\AdminController@getUsers')->name('users');
        Route::delete('/admin/users', 'Admin\AdminController@deleteUser')->name('admin.delete.user');
        Route::put('/admin/users', 'Admin\AdminController@getTasks')->name('admin.user.tasks');
        Route::delete('/admin/users/{taskId}', 'Admin\AdminController@deleteTask')->name('admin.delete.task');
        Route::get('/admin/users/{taskId}', 'Admin\AdminController@getComments')->name('comments');

        Route::delete('/admin/users/{commentId}', 'Admin\AdminController@deleteComment')->name('admin.delete.comment');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
