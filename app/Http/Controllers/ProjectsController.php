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


    public function store()
    {
        # code...
        $data = request()->validate(['title' => 'required','description' => 'required']);

        Project::create($data);

        return redirect('/projects');
    }
}
