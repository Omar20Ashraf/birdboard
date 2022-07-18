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
}
