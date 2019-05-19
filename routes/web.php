<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chat', function () {
    return view('chat');
});

Route::get('/execute', function(){
        if(Gate::allows('admin_only',Auth::user()))
            return view('display');
        return 'Not allowed';
    })->name('show');

Route::get('/resource', 'OperationController@resource')->name('resource');
Route::post('/addDummy', 'OperationController@addDummy')->name('dummy.add');

Route::get('/showDummy', 'OperationController@showDummy')->name('dummy.show');

Route::post('/updateDummy', 'OperationController@updateDummy')->name('dummy.update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
