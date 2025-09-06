<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NongHoController;
use App\Http\Controllers\ThuaDatController;
use App\Http\Controllers\CayTrongController;

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

Route::get('/test', function () {
    return response()->json([
        'message' => 'Test API thành công!',
        'time' => now(),
        'version' => app()->version()
    ]);
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Nông hộ routes
Route::resource('nongho', NongHoController::class);

// Thửa đất routes
Route::resource('thuadat', ThuaDatController::class);

// Cây trồng routes - specific routes first, then resource
Route::get('/caytrong/create', [CayTrongController::class, 'create'])->name('caytrong.create');
Route::post('/caytrong', [CayTrongController::class, 'store'])->name('caytrong.store');
Route::get('/caytrong', [CayTrongController::class, 'index'])->name('caytrong.index');
Route::get('/caytrong/{caytrong}', [CayTrongController::class, 'show'])->name('caytrong.show');
Route::get('/caytrong/{caytrong}/edit', [CayTrongController::class, 'edit'])->name('caytrong.edit');
Route::put('/caytrong/{caytrong}', [CayTrongController::class, 'update'])->name('caytrong.update');
Route::delete('/caytrong/{caytrong}', [CayTrongController::class, 'destroy'])->name('caytrong.destroy');

// Statistics route
Route::get('/statistics', function () {
    return view('statistics.index', [
        'totalArea' => 15250.50,
        'activeCrops' => 45,
        'readyToHarvest' => 12,
        'averageEfficiency' => 87,
        'topFarms' => collect([]),
        'recentActivities' => collect([]),
        'cropDistribution' => [],
        'areaByFarm' => [],
        'monthlyGrowth' => []
    ]);
})->name('statistics.index');
