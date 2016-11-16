<?php

namespace App\Http\Controllers;

use App\Model\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function list(Material $materialModel)
    {
        $materials = $materialModel->all();

        return response()->json(compact('materials'));
    }

    public function create(Request $request, Material $materialModel)
    {
        $attributes = $request->only('name', 'unit_name');

        $material = $materialModel->create($attributes);

        return response()->json(compact('material'));
    }
}
