<?php

namespace App\Http\Controllers;
use App\Models\Evaluation;
use App\Models\Evaluator;
use App\Models\Project;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Update the evaluation score based on the provided request data.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
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

    /**
     * Check if keywords match a specific specialty.
     *
     * @param string $keywords
     * @param string $speciality
     * @return bool
     */
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

    /**
     * Generate evaluations for projects based on evaluator preferences.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function generateEvaluations(){
        $maxEvaluations = 5;
        
        //Reset Evaluator and Evaluations Table
        Evaluation::truncate();
        Evaluator::query()->update(['is_max_evaluations' => 0]);
        $evaluators = Evaluator::all();

        $projects = Project::all();
        $this->matchProjectsOnPreferences($evaluators,$projects);
        $this->assignRemainingProjects();
        $evaluations = Evaluation::all();
            return view('project.admin',compact('evaluations'));

    }
    /**
     * Method- Matches projects to evaluators based on preferences.
     * @param evaluators: A collection of all avaliable evaluators.
     * @param projects: A collection of all registered projects.
     * precondition: Evaluation table should be empty and all evaluator's
     * attribute 'is_max_evaluations' should be 0
     * postcondition: Each project who's keywords match with the evaluators
     * speciality should be assigned atleast one evaluator.
    */
    private function matchProjectsOnPreferences($evaluators,$projects){
        foreach ($evaluators as $evaluator) {
            if($evaluator->is_max_evaluation > 5){
                break;
            }
            $preferredCategory = $evaluator->preferred_project_category;
            $speciality = $evaluator->speciality;
    
            $eligibleProjects = $projects->filter(function ($project) use ($preferredCategory, $speciality) {
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
    }
    /*
    * Queries the database for the projects which have not been assigned
    * an evaluator, and assigns them an avaliable evaluator at random.
    * precondition: none
    * postcondition: Every project must be assigned atleast one evaluator.
    */
    private function assignRemainingProjects(){
        $maxEvaluations = 5;
        $projects = Project::all();
        foreach ($projects as $project) {
        $evaluators = $project->evaluators()->get();
        
        if ($evaluators->isEmpty()) {
            $evaluator = Evaluator::where('is_max_evaluations', '<', $maxEvaluations)->inRandomOrder()->first();
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
    }
    
}
