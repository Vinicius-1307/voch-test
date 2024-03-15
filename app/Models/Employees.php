<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    public function createEmployee(array $data): bool
    {
        $this->unit_id = $data['unit_id'];
        $this->name = $data['name'];
        $this->cpf = $data['cpf'];
        $this->email = $data['email'];
        $employee = $this->save();

        $employeePosition = new EmployeePosition();
        $employeePosition->employee_id = $this->id;
        $employeePosition->position_id = $data['position_id'];
        $employeePosition->save();

        return $employee ? true : false;
    }

    public function updatePerformance(array $data): bool
    {
        dd($data);
        $employeePosition = EmployeePosition::where('employee_id', $this->id)->first();

        if ($employeePosition) {
            $employeePosition->performance_note = $data['performance_note'];
            $employeePosition->save();
            return true;
        }

        return false;
    }

    use HasFactory;

    protected $fillable = [
        'unit_id',
        'name',
        'cpf',
        'email'
    ];
}
