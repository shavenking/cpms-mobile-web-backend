<?php

namespace App\Http\Controllers;

use App\Model\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function list(Work $workModel)
    {
        $works = $workModel->all();

        return response()->json(compact('works'));
    }

    public function create(Request $request, Work $workModel)
    {
        $attributes = $request->only(
            'name',
            'unit_name'
        );

        $work = $workModel->create($attributes);

        return response()->json(compact('work'));
    }
}
