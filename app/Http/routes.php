<?php



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['prefix' => 'api/v1/'], function (){

    Route::post('authenticate', 'Auth\AuthenticateController@authenticate');

    Route::group(['middleware' => 'jwt.auth'], function (){
        Route::resource('department', 'DepartmentController');
        Route::get('department/{id}/employees ', 'DepartmentController@showEmployees');
        Route::resource('employee', 'EmployeeController');
    });


});

Route::auth();

Route::get('/home', 'HomeController@index');
