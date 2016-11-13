<?php

namespace App\Http\Controllers;

use App\Model\{
    ConstructionDaily,
    Project,
    Work
};
use Illuminate\Http\Request;

class DailyWorkController extends Controller
{
    public function list(Project $project, ConstructionDaily $constructionDaily)
    {
        $works = $constructionDaily
            ->works()
            ->get(['name', 'unit_name'])
            ->map(function ($work) {
                /**
                 * 轉換 work 的輸出格式
                 * 刪掉 Laravel 多對多關聯時產生的 pivot 屬性
                 */
                $work = array_merge(
                    ['id' => $work->pivot->work_id],
                    $work->toArray(),
                    $work->pivot->toArray()
                );

                unset($work['pivot'], $work['work_id']);

                return $work;
            });

        return response()->json(compact('works'));
    }

    public function create(
        Project $project,
        ConstructionDaily $constructionDaily,
        Work $workModel,
        Request $request
    ) {
        $work = $workModel->find($request->work_id);
        $constructionDaily->works()->attach($work->id, [
            'amount' => $request->amount
        ]);

        return response()->json();
    }
}
