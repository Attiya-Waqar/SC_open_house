<?php

// app/Models/Evaluations.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['evaluator_id', 'project_id', 'is_evaluated', 'score'];
}

