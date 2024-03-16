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
        Route::get('/top-performers', 'topPerformers')->name('get.top_performers');
        Route::get('/get-all', 'getAll')->name('get.all_employees');
        Route::get('/by-units', 'getAllByUnit')->name('get.by_units');

        Route::get('/export-excel/by-performance', 'exportEmployeesNotes')->name('export_employees_note.excel');
        Route::get('/export-excel/all-employees', 'exportAllEmployees')->name('export_all_employees.excel');
        Route::get('/export-excel/by-units', 'exportUnitsWithEmployees')->name('export_by_units.excel');
        Route::get('/export-pdf', 'export')->name('export.pdf');
    });

Route::controller(PositionController::class)
    ->prefix('positions')
    ->group(function () {
        Route::get('/', 'getPositions')->name('get.positions');
    });

Route::get('/units/create', function () {
    return view('units.create');
})->name('unit.index');

Route::get('/employee/create', function () {
    return view('employees.create');
})->name('employee.index');

Route::get('/employee/evaluation', function () {
    return view('employees.evaluation');
})->name('employee.evaluation');

Route::get('/employee/allEmployeesReport', function () {
    return view('employees.allEmployeesReport');
})->name('employee.allEmployeesReport');

Route::get('/employee/byNotesReport', function () {
    return view('employees.byNotesReport');
})->name('employee.byNotesReport');

Route::get('/employee/byUnitsReport', function () {
    return view('employees.byUnitsReport');
})->name('employee.byUnitsReport');
