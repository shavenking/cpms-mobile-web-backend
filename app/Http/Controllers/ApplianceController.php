<?php

namespace App\Http\Controllers;

use App\Model\Appliance;
use Illuminate\Http\Request;

class ApplianceController extends Controller
{
    public function list(Appliance $applianceModel)
    {
        $appliances = $applianceModel->all();

        return response()->json(compact('appliances'));
    }

    public function create(Request $request, Appliance $applianceModel)
    {
        $attributes = $request->only('name', 'unit_name');
        $appliance = $applianceModel->create($attributes);

        return response()->json(compact('appliance'));
    }
}
