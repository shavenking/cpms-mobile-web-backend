<?php

namespace App\Http\Controllers;

use App\Model\{
    ConstructionDaily,
    Project,
    Material
};
use Illuminate\Http\Request;

class DailyMaterialController extends Controller
{
    public function list(Project $project, ConstructionDaily $constructionDaily)
    {
        $materials = $constructionDaily
            ->materials()
            ->get(['name', 'unit_name'])
            ->map(function ($material) {
                /**
                 * 轉換 material 的輸出格式
                 * 刪掉 Laravel 多對多關聯時產生的 pivot 屬性
                 */
                $material = array_merge(
                    ['id' => $material->pivot->material_id],
                    $material->toArray(),
                    $material->pivot->toArray()
                );

                unset($material['pivot'], $material['material_id']);

                return $material;
            });

        return response()->json(compact('materials'));
    }

    public function create(
        Project $project,
        ConstructionDaily $constructionDaily,
        Material $materialModel,
        Request $request
    ) {
        $material = $materialModel->find($request->material_id);
        $constructionDaily->materials()->attach($material->id, [
            'amount' => $request->amount
        ]);

        return response()->json();
    }
}
