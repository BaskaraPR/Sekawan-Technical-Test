<?php

use App\Http\Controllers\driverController;
use App\Http\Controllers\requestController;
use App\Http\Controllers\userController;
use App\Http\Controllers\vehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

//User Routes
Route::get('/user',[userController::class,'index'])->name('user');
Route::post('/user',[userController::class,'store'])->name('user.post');
Route::put('/user/{id}',[userController::class,'update'])->name('user.update');
Route::delete('/user/{id}',[userController::class,'destroy'])->name('user.delete');

//Driver Routes
Route::get('/driver',[driverController::class,'index'])->name('driver');
Route::post('/driver',[driverController::class,'store'])->name('driver.post');
Route::put('/driver/{id}',[driverController::class,'update'])->name('driver.update');
Route::delete('/driver/{id}',[driverController::class,'destroy'])->name('driver.delete');

//Vehicle Routes
Route::get('/vehicle',[vehicleController::class,'index'])->name('vehicle');
Route::post('/vehicle',[vehicleController::class,'store'])->name('vehicle.post');
Route::put('/vehicle/{id}',[vehicleController::class,'update'])->name('vehicle.update');
Route::delete('/vehicle/{id}',[vehicleController::class,'destroy'])->name('vehicle.delete');

//Request Routes
Route::get('/request',[requestController::class,'index'])->name('request');
Route::post('/request',[requestController::class,'store'])->name('request.post');
Route::put('/request/{id}/{id_driver}/{id_vehicle}',[requestController::class,'update'])->name('request.update');
Route::delete('/request/{id}/{id_driver}/{id_vehicle}',[requestController::class,'destroy'])->name('request.delete');