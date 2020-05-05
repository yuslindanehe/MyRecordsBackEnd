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
        Route::post('authenticate-code', 'AuthController@authenticate2FACode');
        Route::get('send-code', 'AuthController@send2FACode');
    });
});

Route::get('medication/patient/','Api\MedicationController@showBasedOnPatient');
Route::post('medication/','Api\MedicationController@store');

Route::post('test-result', 'Api\TestResultController@store');
Route::get('test-result/patient/','Api\TestResultController@showBasedOnPatient');


Route::get('health-information/patient/','Api\HealthInformationController@showBasedOnPatient');

Route::apiResource('patients', 'Api\PatientsController');
Route::apiResource('staffs', 'Api\StaffsController');
Route::apiResource('health-information', 'Api\HealthInformationController');
Route::apiResource('prescription', 'Api\PrescriptionController');
Route::apiResource('visit', 'Api\VisitController');
