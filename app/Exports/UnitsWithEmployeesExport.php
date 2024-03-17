<?php

namespace App\Exports;

use App\Models\Unit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UnitsWithEmployeesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $units = Unit::withCount('employees')
            ->orderBy('fantasy_name')
            ->get();

        $unitData = [];

        foreach ($units as $unit) {
            $unitData[] = [
                'Nome Fantasia' => $unit->fantasy_name,
                'Razão Social' => $unit->company_name,
                'CNPJ' => $unit->cnpj,
                'Quantidade de Colaboradores' => $unit->employees_count !== null ? (string) $unit->employees_count : '0',
            ];
        }
        return new Collection($unitData);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nome Fantasia',
            'Razão Social',
            'CNPJ',
            'Quantidade de Colaboradores',
        ];
    }
}
