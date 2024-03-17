<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'fantasy_name',
        'company_name',
        'cnpj'
    ];

    public function createUnit(array $data):bool
    {
        $unit = $this->save($data);
        return $unit ? true : false;
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
