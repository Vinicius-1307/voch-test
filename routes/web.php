<?php

use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Position\PositionController;
use App\Http\Controllers\Units\UnitController;
use Illuminate\Support\Facades\Route;

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
    return view('layouts.app');
});

Route::controller(UnitController::class)
    ->prefix('units')
    ->group(function () {
        Route::post('/', 'create')->name('units.create');
        Route::get('/', 'getUnits')->name('get.units');
    });

Route::controller(EmployeeController::class)
    ->prefix('employees')
    ->group(function () {
        Route::post('/', 'create')->name('employee.create');
        Route::put('/', 'updateEvaluation')->name('employee.update');
        Route::get('/', 'getEmployees')->name('get.employee');
    });

Route::controller(PositionController::class)
    ->prefix('positions')
    ->group(function () {
        Route::get('/', 'getPositions')->name('get.positions');
    });

// Unidades
Route::get('/units/create', function () {
    return view('units.create');
})->name('unit.index');
// Colaboradores
Route::get('/employee/create', function () {
    return view('employees.create');
})->name('employee.index');
Route::get('/employee/evaluation', function () {
    return view('employees.evaluation');
})->name('employee.evaluation');
