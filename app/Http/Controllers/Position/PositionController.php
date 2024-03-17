<?php

namespace App\Http\Controllers\Position;

use App\Http\Controllers\Controller;
use App\Models\Position;

class PositionController extends Controller
{
    public function getPositions()
    {
        $positions = Position::select('id', 'position')->get();
        return response()->json($positions);
    }
}
