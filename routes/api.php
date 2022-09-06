<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TypeVehicleController;
use App\Http\Controllers\EntranceExitController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MonthTimeController;




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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
/*  Route::middleware(['auth'=> 'auth:api'])->group(function () {
     
 }); */
Route::controller(VehicleController::class)->group(function () {
    Route::get('/vehicles', 'index');
    Route::post('/vehicle', 'store');
    Route::get('/vehicle/show/{id}', 'show');
    Route::post('/vehicle/update/{id}', 'update');
    Route::post('/vehicle/upgrade/', 'upgrade');
    Route::post('/vehicle/delete/{id}', 'destroy');
});

Route::controller(TypeVehicleController::class)->group(function () {
    Route::get('/typevehicles', 'index');
    Route::post('/typevehicle', 'store');
    Route::get('/typevehicle/show/{id}', 'show');
    Route::post('/typevehicle/update/{id}', 'update');
    Route::post('/typevehicle/delete/{id}', 'destroy');
});

Route::controller(EntranceExitController::class)->group(function () {
    Route::get('/entrancesexits', 'index');
    Route::post('/entranceexit', 'store');
    Route::get('/entranceexit/show/{id}', 'show');
    Route::post('/entranceexit/update/{id}', 'update');
    Route::post('/entrance-exit/delete/{id}', 'destroy');

    //views
    Route::post('/entranceexit/entrance', 'entrance');
    Route::post('/entranceexit/exit', 'exit');



});

Route::controller(MonthTimeController::class)->group(function () {
    Route::get('/monthtimes', 'index');
    Route::post('/monthtime', 'store');
    Route::get('/monthtime/show/{id}', 'show');
    Route::post('/monthtime/update/{id}', 'update');
    Route::post('/monthtime/delete/{id}', 'destroy');
    Route::get('/reportpayment', 'paymentReport');
    Route::get('/cleanmonth', 'cleanMonth');


});

