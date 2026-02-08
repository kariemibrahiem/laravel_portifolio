<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'collaborator_project', 'collaborator_id', 'project_id');
    }
}
