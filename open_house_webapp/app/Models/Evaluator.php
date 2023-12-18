<?php

// app/Models/Evaluator.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluator extends Model
{
    protected $fillable = ['user_id', 'preferred_project_category', 'speciality', 'is_max_evaluations'];
}

