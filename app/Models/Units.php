<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{

    public function createUnit(array $data):bool
    {
        $unit = $this->save($data);
        return $unit ? true : false;
    }

    use HasFactory;

    protected $fillable = [
        'fantasy_name',
        'company_name',
        'cnpj'
    ];
}
