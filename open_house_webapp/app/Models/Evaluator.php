<?php 
// app/Models/Evaluator.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluator extends Model
{
    // Define the primary key for the evaluator model
    protected $primaryKey = 'user_id';

    // Fillable fields for mass assignment
    protected $fillable = ['user_id', 'preferred_project_category', 'speciality', 'is_max_evaluations'];

    /**
     * Define the relationship between Evaluator and User models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Define the relationship between Evaluator and Project models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(
            Project::class,
            'evaluations',      // Pivot table name
            'evaluator_id',     // Foreign key on the Evaluator model
            'project_id',       // Foreign key on the Project model
            'user_id',          // Local key on the Evaluator model
            'id'                // Local key on the Project model
        );
    }
}
