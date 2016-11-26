<?php

namespace App\Http\Controllers;

use App\Model\{
    Appliance,
    ConstructionDaily,
    Project
};
use Illuminate\Http\Request;

class DailyApplianceController extends Controller
{
    public function list(Project $project, ConstructionDaily $constructionDaily)
    {
        $appliances = $constructionDaily
            ->appliances()
            ->get(['name', 'unit_name'])
            ->map(function ($appliance) {
                /**
                 * 轉換 appliance 的輸出格式
                 * 刪掉 Laravel 多對多關聯時產生的 pivot 屬性
                 */
                $appliance = array_merge(
                    ['id' => $appliance->pivot->appliance_id],
                    $appliance->toArray(),
                    $appliance->pivot->toArray()
                );

                unset($appliance['pivot'], $appliance['appliance_id']);

                return $appliance;
            });

        return response()->json(compact('appliances'));
    }

    public function create(
        Project $project,
        ConstructionDaily $constructionDaily,
        Appliance $applianceModel,
        Request $request
    ) {
        $appliance = $applianceModel->find($request->appliance_id);
        $constructionDaily->appliances()->attach($appliance->id, [
            'amount' => $request->amount
        ]);

        return response()->json();
    }
}
