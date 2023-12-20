<?php

// app/Models/Project.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['project_name', 'project_category', 'project_description', 'stall_location', 'keywords','user_id'];
    public function evaluators()
    {
        return $this->belongsToMany(Evaluator::class, 'evaluations', 'project_id', 'evaluator_id','id','user_id');

    }
}

