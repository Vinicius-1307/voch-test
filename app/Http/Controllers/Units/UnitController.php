<?php

namespace App\Http\Controllers\Units;

use App\Http\Controllers\Controller;
use App\Http\Requests\Units\CreateUnitRequest;
use App\Models\Unit;
use Exception;

class UnitController extends Controller
{
    public function __construct(protected Unit $unit)
    {
    }

    public function create(CreateUnitRequest $request)
    {
        try {
            $data = $request->validated();
            $data['cnpj'] = preg_replace('/\D/', '', $data['cnpj']);
            if ($this->unit->createUnit($data))
                return back()->with('success', 'Unidade criada com sucesso!');
            else
                return back()->with('error', 'Erro ao criar a unidade!');
        } catch (Exception $err) {
            return response()->json($err->getMessage(), 500);
        }
    }

    public function getUnits()
    {
        try {
            $units = $this->unit->select('id', 'fantasy_name')->get();
            return response()->json($units);
        } catch (Exception $err) {
            return response()->json($err->getMessage(), 500);
        }
    }
}
