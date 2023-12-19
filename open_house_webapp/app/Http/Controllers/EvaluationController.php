<?php

namespace App\Http\Controllers;
use App\Models\Evaluation;
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
    public function generateEvaluations(){
        return view('welcome');

    }
}
