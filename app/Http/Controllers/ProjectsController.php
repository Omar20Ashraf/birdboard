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
        $projects = auth()->user()->projects;

        return view('projects.index',compact('projects'));
    }

    public function create()
    {
        # code...
        return view('projects.create');
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

        return view('projects.show', compact('project'));
    }
}
