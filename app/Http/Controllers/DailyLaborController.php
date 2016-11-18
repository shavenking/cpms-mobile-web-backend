<?php

namespace App\Http\Controllers;

use App\Model\{
    ConstructionDaily,
    Labor,
    Project
};
use Illuminate\Http\Request;

class DailyLaborController extends Controller
{
    public function list(Project $project, ConstructionDaily $constructionDaily)
    {
        $labors = $constructionDaily
            ->labors()
            ->get(['name', 'unit_name'])
            ->map(function ($labor) {
                /**
                 * 轉換 labor 的輸出格式
                 * 刪掉 Laravel 多對多關聯時產生的 pivot 屬性
                 */
                $labor = array_merge(
                    ['id' => $labor->pivot->labor_id],
                    $labor->toArray(),
                    $labor->pivot->toArray()
                );

                unset($labor['pivot'], $labor['labor_id']);

                return $labor;
            });

        return response()->json(compact('labors'));
    }

    public function create(
        Project $project,
        ConstructionDaily $constructionDaily,
        Labor $laborModel,
        Request $request
    ) {
        $labor = $laborModel->find($request->labor_id);
        $constructionDaily->labors()->attach($labor->id, [
            'amount' => $request->amount
        ]);

        return response()->json();
    }
}
