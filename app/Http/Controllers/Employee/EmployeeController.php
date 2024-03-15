<?php

namespace App\Http\Controllers\Employee;

use App\Exports\AllEmployeesExport;
use App\Exports\EmployeeNotesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\GetByUnitRequest;
use App\Http\Requests\Employee\UpdatePerformanceRequest;
use App\Models\EmployeePosition;
use App\Models\Employees;
use App\Models\Units;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function __construct(protected Employees $employees)
    {
    }

    public function create(CreateEmployeeRequest $request)
    {
        $data = $request->validated();
        dd($data);
        $data['cpf'] = preg_replace('/\D/', '', $data['cpf']);
        if ($this->employees->createEmployee($data))
            return back()->with('success', 'Colaborador criado com sucesso!');
        else
            return back()->with('error', 'Erro ao criar o colaborador!');
    }

    public function updateEvaluation(UpdatePerformanceRequest $request)
    {
        $data = $request->validated();
        $employeeId = $data['employee_id'];
        $employee = Employees::find($employeeId);
        if (!$employee)
            return back()->with('error', 'Colaborador não encontrado!');
        $this->employees->updatePerformance($request->validated());
        return back()->with('success', 'Desempenho do colaborador atualizado com sucesso!');
    }

    public function getEmployees()
    {
        $employees = Employees::select('id', 'name')->get();
        return response()->json($employees);
    }

    public function getAll()
    {
        $employees = EmployeePosition::with(['employee.unit', 'position'])
        ->get();
        $formattedEmployees = $employees->map(function ($employeePosition) {
            return [
                'Nome' => $employeePosition->employee->name,
                'CPF' => $employeePosition->employee->cpf,
                'Email' => $employeePosition->employee->email,
                'Unidade' => $employeePosition->employee->unit->fantasy_name,
                'Cargo' => $employeePosition->position->position,
            ];
        });
        return view('reports.allEmployees')->with('employees', $formattedEmployees);
    }

    public function getAllByUnit()
    {
        $units = Units::withCount('employees')->get();
        return view('reports.byUnit', compact('units'));
    }

    public function topPerformers()
    {
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
    }

    public function exportEmployeesNotes()
    {
        return Excel::download(new EmployeeNotesExport, 'relatorio_de_desempenho.xlsx');
    }

    public function exportAllEmployees()
    {
        return Excel::download(new AllEmployeesExport, 'relatorio_de_desempenho.xlsx');
    }
}
