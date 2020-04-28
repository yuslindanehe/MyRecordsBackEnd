<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('user', 'AuthController@me');
    });

    Route::apiResource('patients', 'PatientsController');
    Route::apiResource('staffs', 'StaffsController');
    Route::apiResource('healthInformation', 'HealthInformationController');
    Route::apiResource('medication', 'MedicationController');
    Route::apiResource('prescription', 'PrescriptionController');
    Route::apiResource('visit', 'VisitController');
});

//Route::post('/login', 'API\LoginController@authenticate');
