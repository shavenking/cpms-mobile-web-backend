<?php

namespace App\Http\Controllers;

use App\Model\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function list(Project $projectModel)
    {
        $projects = $projectModel->all();

        return response()->json(compact('projects'));
    }

    public function show(Project $project)
    {
        return response()->json(compact('project'));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $attributes = $request->only(
            'name', // 工程名稱
            'contractor', // 承攬廠商
            'total_day', // 核定工期
            'start_date' // 開工日期
        );

        $project = $user->projects()->create($attributes);

        return response()->json($project->toArray());
    }
}
