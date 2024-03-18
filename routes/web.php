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
        //Route for view
        Route::get('/create', function () {
            return view('units.create');
        })->name('unit.index');
    });

Route::controller(EmployeeController::class)
    ->prefix('employees')
    ->group(function () {
        //Routes for controllers
        Route::post('/', 'create')->name('employee.create');
        Route::put('/', 'updateEvaluation')->name('employee.update');
        Route::get('/', 'getEmployees')->name('get.employee');
        Route::get('/top-performers', 'topPerformers')->name('get.top_performers');
        Route::get('/get-all', 'getAll')->name('get.all_employees');
        Route::get('/by-units', 'getAllByUnit')->name('get.by_units');
        //Routes for views
        Route::get('/create', function () {
            return view('employees.create');
        })->name('employee.index');

        Route::get('/evaluation', function () {
            return view('employees.evaluation');
        })->name('employee.evaluation');

        Route::get('/allEmployeesReport', 'getAll')->name('employee.allEmployeesReport');
        Route::get('/byUnitsReport', 'getAllByUnit')->name('employee.byUnitsReport');
        Route::get('/byNotesReport', 'topPerformers')->name('employee.byNotesReport');

        //Routes for excel export
        Route::get('/export-excel/by-performance', 'exportEmployeesNotes')->name('export_employees_note.excel');
        Route::get('/export-excel/all-employees', 'exportAllEmployees')->name('export_all_employees.excel');
        Route::get('/export-excel/by-units', 'exportUnitsWithEmployees')->name('export_by_units.excel');
    });

Route::controller(PositionController::class)
    ->prefix('positions')
    ->group(function () {
        Route::get('/', 'getPositions')->name('get.positions');
    });
