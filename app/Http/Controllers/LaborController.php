<?php

namespace App\Http\Controllers;

use App\Model\Labor;
use Illuminate\Http\Request;

class LaborController extends Controller
{
    public function list(Labor $laborModel)
    {
        $labors = $laborModel->all();

        return response()->json(compact('labors'));
    }

    public function create(Request $request, Labor $laborModel)
    {
        $attributes = $request->only('name', 'unit_name');
        $labor = $laborModel->create($attributes);

        return response()->json(compact('labor'));
    }
}
