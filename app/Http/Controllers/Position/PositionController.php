<?php

namespace App\Http\Controllers\Position;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Exception;

class PositionController extends Controller
{
    public function __construct(protected Position $position)
    {
    }

    public function getPositions()
    {
        try {
            $positions = $this->position->select('id', 'position')->get();
            return response()->json($positions);
        } catch (Exception $err) {
            return response()->json($err->getMessage(), 500);
        }
    }
}
