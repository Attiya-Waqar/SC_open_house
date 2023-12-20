<?php

namespace App\Http\Controllers;
use App\Models\Evaluation;
use App\Models\Evaluator;
use App\Models\Project;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function updateEvaluation(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
        ]);

        // Retrieve the evaluation by ID
        $evaluations = Evaluation::findOrFail($id);

        // Update the score
        $evaluations->is_evaluated = true;
        $evaluations->score = $request->input('score');
        $evaluations->save();

        // Redirect back to the evaluation details page
        return view('project.evaluations',compact('evaluations'));
    }
    private function matchKeywords($keywords, $speciality){
        $keywords = explode(',', $keywords);
        $speciality = explode(',', $speciality);
        $similarKeywords = array_intersect($keywords, $speciality);
        if(empty($similarKeywords)){
            return false;
        }
        else{
            return true;
        }
    }
    public function generateEvaluations(){
    $maxEvaluations = 5;
    Evaluation::truncate();
    Evaluator::query()->update(['is_max_evaluations' => 0]);

    $evaluators = Evaluator::all();
    $projects = Project::all();

    foreach ($evaluators as $evaluator) {
        if($evaluator->is_max_evaluation > 5){
            break;
        }
        $preferredCategory = $evaluator->preferred_project_category;
        $speciality = $evaluator->speciality;

        $eligibleProjects = $projects->filter(function ($project) use ($preferredCategory, $speciality, $evaluator) {
            $isSpeciality = $this->matchKeywords($project->keywords, $speciality);
            return $project->project_category == $preferredCategory && $isSpeciality;
        });

        foreach ($eligibleProjects as $eligibleProject) {
            $evaluationData = [
                'is_evaluated' => false, // or true, depending on your logic
                'score' => 0, // Provide a default value for the score column
            ];
        
            $evaluator->projects()->attach($eligibleProject, $evaluationData);
            $evaluator->is_max_evaluations += 1;
            $evaluator->save();
            
        }
    }
    $projects = Project::all();
    foreach ($projects as $project) {
        $evaluators = $project->evaluators()->get();
        
        if ($evaluators->isEmpty()) {
            $evaluator = Evaluator::where('is_max_evaluations', '<', 5)->inRandomOrder()->first();
            if ($evaluator) {
                $evaluationData = [
                    'is_evaluated' => false, 
                    'score' => 0, 
                ];
                $evaluator->projects()->attach($project, $evaluationData);
                $evaluator->is_max_evaluations += 1;
                $evaluator->save();
            }
        }
    }
    $evaluations = Evaluation::all();
        return view('project.admin',compact('evaluations'));

    }
    
}
