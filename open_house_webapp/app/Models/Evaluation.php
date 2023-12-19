<?php

// app/Models/Evaluations.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['evaluator_id', 'project_id', 'is_evaluated', 'score'];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function evaluator()
    {
        return $this->belongsTo(Evaluator::class, 'evaluator_id','user_id');
    }
    
}

