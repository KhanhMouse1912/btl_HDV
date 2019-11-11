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

Route::get('admin', function () {
    return view('admin.home.index');
});

Route::get('getDistrict', 'RelationshipController@getDistrictByCity');
Route::get('getWard', 'RelationshipController@getWardByDistrict');
Route::post('createKindOfRelationship', 'KindOfRelationShipController@store');

Route::group(['prefix' => '/relationship'], function() {
    Route::get('/', 'RelationshipController@index');
    Route::get('/create', 'RelationshipController@store');
    Route::get('/update', 'RelationshipController@update');
    Route::get('/delete/{id}', 'RelationshipController@deleteById');    
});

Route::get('signup', function () {
    return view('user.signup.index');
})->name('signup');

Route::get('signin', function () {
    return view('user.signin.index');
})->name('signin');

Route::get('/', function () {
    return view('user.signin.index');
})->name('home');

Route::post('signin', 'Auth\LoginController@postSignin');
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['prefix' => '/user'], function() {
    Route::get('relationship', 'RelationshipController@index')->name('user_relationship');
    Route::get('notification', 'ReminderController@index')->name('user_notification');
});


Route::post('/reminder', 'ReminderController@create');

Route::post('signup','Auth\RegisterController@register');