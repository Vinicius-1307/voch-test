<?php

namespace App\Exports;

use App\Models\EmployeePosition;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllEmployeesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $employees = EmployeePosition::with(['employee.unit', 'position'])
            ->join('employees', 'employees.id', '=', 'employee_positions.employee_id')
            ->orderBy('employees.name')
            ->get();

        $formattedData = $employees->map(function ($employeePosition) {
            return [
                'Nome' => $employeePosition->employee->name,
                'CPF' => $employeePosition->employee->cpf,
                'Email' => $employeePosition->employee->email,
                'Unidade' => $employeePosition->employee->unit->fantasy_name,
                'Cargo' => $employeePosition->position->position
            ];
        });

        return new Collection($formattedData->values());
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nome',
            'CPF',
            'Email',
            'Unidade',
            'Cargo'
        ];
    }
}
