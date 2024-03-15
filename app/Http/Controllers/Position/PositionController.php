<?php

namespace App\Http\Controllers\Position;

use App\Http\Controllers\Controller;
use App\Models\Positions;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function getPositions()
    {
        $positions = Positions::select('id', 'position')->get();
        return response()->json($positions);
    }
}
