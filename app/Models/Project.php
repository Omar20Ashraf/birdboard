<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'owner_id',
        'description'
    ];

    public function path()
    {
        # code...
        return "/projects/{$this->id}";
    }

    public function owner()
    {
        # code...
        return $this->belongsTo(User::class,'owner_id');
    }

    public function tasks()
    {
        # code...
        return $this->hasMany(Task::class,'project_id');
    }

    public function addTask($data)
    {
        # code...
        return $this->tasks()->create($data);
    }
}
