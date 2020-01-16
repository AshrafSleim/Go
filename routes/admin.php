<?php

Route::get('/login', 'admin@showAdminLoginForm')->name('AdminLogin');
Route::post('/login', 'admin@loginAdmin')->name('PostAdminLogin');

Route::get('/dropdownlist/getDriver/{id}', 'Admin\TripController@getBusDriver');


Route::group(['middleware' => 'Admin:admin'], function () {
    Route::get('/register', 'admin@showAdminRegisterForm')->name('AdminRegistration');
    Route::post('/register', 'admin@createAdmin')->name('PostAdminRegistration');

    Route::get('/', function () {
        session()->forget('menu');
        session()->put('menu', 'home');
        return view('admin.home');
    })->name('adminHome');

    Route::get('/logout', 'admin@logout')->name('logoutAdmin');
    Route::group(['namespace' => 'Admin'], function () {
//Driver route
        Route::get('user', 'User@index')->name('adminUser.index');
        Route::post('/deleteUser/{id}', 'User@delete')->name('adminUser.delete');
        Route::get('/addDriver', 'User@getNewDriver')->name('adminAddDriver');
        Route::post('/addDriver', 'User@postNewDriver')->name('adminAddDriverPost');
//Bus route
        Route::get('/AllBuses', 'BusController@index')->name('AllBuses');
        Route::post('/deleteBus/{id}', 'BusController@delete')->name('deleteBus');
        Route::post('/addBus', 'BusController@addBus')->name('addBus');
        Route::get('/allDriverOfBus/{id}', 'BusController@allDriverOfBus')->name('AllDriverOfBus');
        Route::post('/addBusDriver/{id}', 'BusController@addBusDriver')->name('addBusDriver');
        Route::post('/deleteBusDriver/{id}', 'BusController@deleteBusDriver')->name('deleteBusDriver');
//Station route
        Route::get('/AllStation', 'StationController@index')->name('AllStation');
        Route::post('/deleteStation/{id}', 'StationController@delete')->name('deleteStation');
        Route::post('/addStation', 'StationController@addStation')->name('addStation');
//Trip route
        Route::get('/AllTrips', 'TripController@index')->name('AllTrips');
        Route::get('/addNewTrip', 'TripController@addNew')->name('addNewTrip');
        Route::post('/addNewTrip', 'TripController@saveNew')->name('saveNewTrip');
        Route::post('/deleteTrip/{id}', 'TripController@delete')->name('deleteTrip');
//Trip Station route
        Route::get('/allStationOfTrip/{id}', 'TripController@allStation')->name('allStationOfTrip');
        Route::post('/addNewTripStation/{id}', 'TripController@addNewStation')->name('addNewTripStation');
        Route::post('/deleteTripStation/{id}', 'TripController@deleteStation')->name('deleteTripStation');
//reports route
        Route::get('/allReports', 'TripController@getReports')->name('allReports');

    });
});
