<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelTempClass;
use App\Http\Controllers\ExcelController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/excel-test', [ExcelController::class, 'getData']);

// Route::get('/store-queue', [ExcelController::class, 'storeQueue']);
Route::get('/store-queue', [ExcelTempClass::class, 'totalAdd']);
Route::get('/prices', [ExcelTempClass::class, 'getPricePV']);

