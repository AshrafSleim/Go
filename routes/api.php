<?php

use Illuminate\Http\Request;

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
Route::group(['namespace' => 'Api'], function () {

        Route::post('loginDriver', 'AuthDriver@login');
        Route::post('loginPassenger', 'AuthPassenger@login');
        Route::post('registerPassenger', 'AuthPassenger@register');

 //passenger route
        Route::group(['middleware' => ['api', 'multiauth:passenger']], function () {
            Route::get('/passenger', 'AuthPassenger@getUser');
            Route::get('logoutPassenger', 'AuthPassenger@logOut');
            Route::post('/searchTrip', 'PassengerController@searchTrip');
            Route::post('/bookingTrip', 'PassengerController@bookingTrip');
            Route::post('/tripInformation', 'PassengerController@getTripInfo');
            Route::get('/allPreviousTrip', 'PassengerController@allPreviousTrip');
            Route::post('/makeRate', 'PassengerController@makeRate');

        });



 //Driver route
        Route::group(['middleware' => ['api', 'multiauth:api']], function () {
            Route::get('/driver', 'AuthDriver@getUser');
            Route::get('logoutDriver', 'AuthDriver@logOut');
            Route::get('/allTrips', 'DriverController@getAllTrip');
            Route::post('/startTrip', 'DriverController@startTrip');
            Route::post('/endTrip', 'DriverController@endTrip');
            Route::post('/startTripPassenger', 'DriverController@startTripPassenger');
            Route::post('/endTripPassenger', 'DriverController@endTripPassenger');

        });
});


