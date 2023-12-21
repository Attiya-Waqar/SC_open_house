<?php
// app/Models/Project.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Fillable fields for mass assignment
    protected $fillable = ['project_name', 'project_category', 'project_description', 'stall_location', 'keywords', 'user_id'];

    /**
     * Define the relationship between Project and Evaluator models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function evaluators()
    {
        return $this->belongsToMany(
            Evaluator::class,            // Related Evaluator model
            'evaluations',               // Pivot table name
            'project_id',               // Foreign key on the Project model
            'evaluator_id',             // Foreign key on the Evaluator model
            'id',                        // Local key on the Project model
            'user_id'                   // Local key on the Evaluator model
        );
    }
}
