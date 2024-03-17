<?php

namespace App\Http\Controllers\Employee;

use App\Exports\AllEmployeesExport;
use App\Exports\EmployeeNotesExport;
use App\Exports\UnitsWithEmployeesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdatePerformanceRequest;
use App\Models\Employee;
use App\Models\EmployeePosition;
use App\Models\Unit;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function __construct(protected Employee $employee)
    {
    }

    public function create(CreateEmployeeRequest $request)
    {
        try {
            $data = $request->validated();
            $data['cpf'] = preg_replace('/\D/', '', $data['cpf']);
            if ($this->employee->createEmployee($data))
                return back()->with('success', 'Colaborador criado com sucesso!');
            else
                return back()->with('error', 'Erro ao criar o colaborador!');
        } catch (Exception $err) {
            return response()->json($err->getMessage(), 500);
        }
    }

    public function updateEvaluation(UpdatePerformanceRequest $request)
    {
        try {
            $data = $request->validated();
            $employeeId = $data['employee_id'];
            $employee = $this->employee->find($employeeId);
            if (!$employee)
                return back()->with('error', 'Colaborador não encontrado!');
            $this->employee->updatePerformance($request->validated());
            return back()->with('success', 'Desempenho do colaborador atualizado com sucesso!');
        } catch (Exception $err) {
            return response()->json($err->getMessage(), 500);
        }
    }

    public function getEmployees()
    {
        try {
            $employees = $this->employee->select('id', 'name')->get();
            return response()->json($employees);
        } catch (Exception $err) {
            return response()->json($err->getMessage(), 500);
        }
    }

    public function getAll()
    {
        try {
            $employees = EmployeePosition::with(['employee.unit', 'position'])
                ->join('employees', 'employees.id', '=', 'employee_positions.employee_id')
                ->orderBy('employees.name')
                ->get()
                ->map(function ($employeePosition) {
                    return [
                        'Nome' => $employeePosition->employee->name,
                        'CPF' => $employeePosition->employee->cpf,
                        'Email' => $employeePosition->employee->email,
                        'Unidade' => $employeePosition->employee->unit->fantasy_name,
                        'Cargo' => $employeePosition->position->position,
                    ];
                });
            return view('tables.allEmployees')->with('employees', $employees);
        } catch (Exception $err) {
            return response()->json($err->getMessage(), 500);
        }
    }

    public function getAllByUnit()
    {
        try {
            $units = Unit::withCount('employees')->get();
            return view('tables.byUnit', compact('units'));
        } catch (Exception $err) {
            return response()->json($err->getMessage(), 500);
        }
    }

    public function topPerformers()
    {
        try {
            $topPerformers = EmployeePosition::orderBy('performance_note', 'desc')
                ->with(['employee.unit', 'position'])
                ->get();

            $formattedTopPerformers = $topPerformers->map(function ($employeePosition) {
                return [
                    'Nome' => $employeePosition->employee->name,
                    'CPF' => $employeePosition->employee->cpf,
                    'Email' => $employeePosition->employee->email,
                    'Unidade' => $employeePosition->employee->unit->fantasy_name,
                    'Cargo' => $employeePosition->position->position,
                    'Nota de Desempenho' => $employeePosition->performance_note,
                ];
            });

            return view('tables.topPerformers')->with('employees', $formattedTopPerformers);
        } catch (Exception $err) {
            return response()->json($err->getMessage(), 500);
        }
    }

    //Functions to generate Excel
    public function exportEmployeesNotes()
    {
        return Excel::download(new EmployeeNotesExport, 'relatorio_de_desempenho.xlsx');
    }

    public function exportAllEmployees()
    {
        return Excel::download(new AllEmployeesExport, 'relatorio_de_colaboradores.xlsx');
    }

    public function exportUnitsWithEmployees()
    {
        return Excel::download(new UnitsWithEmployeesExport, 'relatorio_de_unidades.xlsx');
    }
}
