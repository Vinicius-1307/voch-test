<?php

namespace App\Http\Controllers\Units;

use App\Http\Controllers\Controller;
use App\Http\Requests\Units\CreateUnitRequest;
use App\Models\Units;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function create(CreateUnitRequest $request)
    {
        $data = $request->all();
        $data['cnpj'] = preg_replace('/\D/', '', $data['cnpj']);

        Units::create($data);
        return back()->with('success', 'Unidade criada com sucesso!');
    }

    public function getUnits()
    {
        $units = Units::select('id', 'fantasy_name')->get();

        return response()->json($units);
    }
}