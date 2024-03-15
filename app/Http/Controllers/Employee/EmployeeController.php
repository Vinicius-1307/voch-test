<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdatePerformanceRequest;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(protected Employees $employees)
    {
    }

    public function create(CreateEmployeeRequest $request)
    {
        $data = $request->validated();
        $data['cpf'] = preg_replace('/\D/', '', $data['cpf']);
        if ($this->employees->createEmployee($data))
            return back()->with('success', 'Colaborador criado com sucesso!');
        else
            return back()->with('error', 'Erro ao criar o colaborador!');
    }

    public function updateEvaluation(UpdatePerformanceRequest $request)
    {
        $employeeId = $request->input('employee_id');
        $employee = Employees::find($employeeId);
        if (!$employee)
            return back()->with('error', 'Colaborador não encontrado!');
        $this->employees->updatePerformance($request->validated());
        return back()->with('success', 'Desempenho do colaborador atualizado com sucesso!');
    }

    public function getEmployees()
    {
        $employess = Employees::select('id', 'name')->get();
        return response()->json($employess);
    }
}
