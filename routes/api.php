<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveRequestController;


Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){

    Route::post('/logout',[AuthController::class,'logout']);

    // Employee
    Route::post('/leave-requests',[LeaveRequestController::class,'store']);
    Route::get('/leave-requests/me',[LeaveRequestController::class,'myLeaves']);

    // Admin
    Route::middleware('admin')->group(function(){
        Route::get('/leave-requests',[LeaveRequestController::class,'index']);
        Route::get('/leave-requests/employee/{userId}',[LeaveRequestController::class,'getEmployeeLeaves']);
        Route::put('/leave-requests/{id}/approve',[LeaveRequestController::class,'approve']);
        Route::put('/leave-requests/{id}/reject',[LeaveRequestController::class,'reject']);
    });
});
