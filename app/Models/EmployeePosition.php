<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_id',
        'employee_id',
        'performance_note'
    ];

    public function position()
    {
        return $this->belongsTo(Positions::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
