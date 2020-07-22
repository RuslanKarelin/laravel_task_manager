<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('issues', 'TaskManager\IssuesController');
    Route::resource('issue-statuses', 'TaskManager\IssueStatusesController');
    Route::resource('sources', 'TaskManager\SourcesController');
    Route::resource('projects', 'TaskManager\ProjectsController');
    Route::post('upload-file', 'TaskManager\FileController@upload')->name('upload-file');
    Route::post('remove-file', 'TaskManager\FileController@remove')->name('remove-file');
    Route::get('download-file/{path}', 'TaskManager\FileController@download')->name('download-file');
    Route::get('ckeditor', 'TaskManager\CkeditorController@index');
    Route::post('ckeditor/upload', 'TaskManager\CkeditorController@upload')->name('ckeditor.upload');
    Route::get('profile/{id}', 'TaskManager\ProfileController@edit')->name('profile.edit');
    Route::put('user-info/{id}', 'TaskManager\ProfileController@updateUserInfo')->name('user-info.update');
    Route::put('user-password/{id}', 'TaskManager\ProfileController@updateUserPassword')->name('user-password.update');
    Route::get('issues-filter', 'TaskManager\IssuesController@filter')->name('issues-filter.index');
    Route::get('/', 'TaskManager\HomeController@index')->name('home');
});

Auth::routes(['register' => false]);
