<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsTasksController extends Controller
{
    //
    public function store(Project $project)
    {
        # code...
        $data = request()->validate([
            'body' => 'required',
        ]);

        $project->addTask($data);

        return redirect($project->path());
    }
}
