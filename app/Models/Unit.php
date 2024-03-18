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
        $existingUnit = $this->where('cnpj', $data['cnpj'])
            ->first();

        if ($existingUnit) {
            return false;
        }
        $this->fantasy_name = $data['fantasy_name'];
        $this->company_name = $data['company_name'];
        $this->cnpj = $data['cnpj'];
        $unit = $this->save($data);
        return $unit ? true : false;
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'units_id');
    }
}
