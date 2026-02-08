<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectHasCollaborator extends Model
{
    protected $fillable = [
        'project_id',
        'collaborator_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class);
    }
}
