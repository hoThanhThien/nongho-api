<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NongHoController;
use App\Http\Controllers\Api\ThuaDatController;
use App\Http\Controllers\Api\CayTrongController;

Route::apiResource('nongho', NongHoController::class);
Route::apiResource('thuadat', ThuaDatController::class);
Route::apiResource('caytrong', CayTrongController::class); // đủ CRUD
