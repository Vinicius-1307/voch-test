<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'units_id',
        'name',
        'cpf',
        'email'
    ];

    public function createEmployee(array $data): bool
    {
        $this->units_id = $data['units_id'];
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
        $employeePosition = EmployeePosition::where('employee_id', $data['employee_id'])->first();

        if ($employeePosition) {
            $employeePosition->performance_note = $data['performance_note'];
            $employeePosition->save();
            return true;
        }
        return false;
    }

    public function unit()
    {
        return $this->belongsTo(Units::class, 'units_id');
    }
}
