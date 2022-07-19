<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    //
    public function index()
    {
        # code...
    }

    public function create()
    {
        # code...
    }

    public function store()
    {
        # code...
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        auth()->user()->projects()->create($data);

        return redirect('/projects');
    }

    public function show(Project $project)
    {
        # code...
        if(auth()->user()->isNot($project->owner)){
            abort(403);
        }
        return ['title' => $project->title,'description' => $project->description];
    }
}
