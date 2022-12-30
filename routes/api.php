<?php

use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\OvertimeController;
use App\Http\Controllers\API\SettingController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/settings', [SettingController::class, 'updateSetting']);

Route::prefix('settings')->group(function () {
    Route::patch('/', [SettingController::class, 'updateSetting']);
});

Route::prefix('employees')->group(function () {
    Route::post('/', [EmployeeController::class, 'storeEmployee']);
});

Route::prefix('overtimes')->group(function () {
    Route::post('/', [OvertimeController::class, 'storeOvertime']);
});
Route::prefix('overtime-pays')->group(function () {
    Route::get('/calculate', [OvertimeController::class, 'getOvertimePay']);
});
