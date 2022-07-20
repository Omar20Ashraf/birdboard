<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'body',
        'completed'
    ];

    public function project()
    {
        # code...
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function path()
    {
        # code...
        return '/projects/' . $this->project->id . '/tasks/' . $this->id;
    }

}
