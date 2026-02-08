<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        "link",
        "collaborators",
        "image",
        "partner_id"
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
    public function collaborators()
    {
        return $this->belongsToMany(Collaborator::class, 'collaborator_project', 'project_id', 'collaborator_id');
    }
}
