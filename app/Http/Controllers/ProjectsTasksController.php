<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use PDO;

class ProjectsTasksController extends Controller
{
    //
    public function store(Project $project)
    {
        # code...
        if(auth()->user()->isNot($project->owner))
            abort(403);

        $data = request()->validate([
            'body' => 'required',
        ]);

        $project->addTask($data);

        return redirect($project->path());
    }
}
