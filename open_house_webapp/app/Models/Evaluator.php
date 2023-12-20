<?php

// app/Models/Evaluator.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluator extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'preferred_project_category', 'speciality', 'is_max_evaluations'];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function projects()
    {
    return $this->belongsToMany(Project::class, 'evaluations','evaluator_id','project_id','user_id','id');
    }
}

