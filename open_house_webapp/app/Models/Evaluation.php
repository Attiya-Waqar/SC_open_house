<?php

// app/Models/Evaluation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    // Fillable fields for mass assignment
    protected $fillable = ['evaluator_id', 'project_id', 'is_evaluated', 'score'];

    /**
     * Define the relationship between Evaluation and Project models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Define the relationship between Evaluation and Evaluator models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evaluator()
    {
        return $this->belongsTo(Evaluator::class, 'evaluator_id', 'user_id');
    }
}
?>

