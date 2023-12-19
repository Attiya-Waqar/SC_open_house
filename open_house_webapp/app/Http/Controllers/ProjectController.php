<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function register()
    {
        $user = Auth::user();

        $view = match ($user->role) {
            'admin' => view(''),
            'evaluator' => function () use ($user) {
                $evaluations = Evaluation::where('evaluator_id', $user->id)->first();
                
                if (!$evaluations) {
                    return view('project.no_evaluations');
                } else {
                    $project = Project::where('id', $evaluations->project_id)->first();
                    return view('project.evaluations', compact('project', 'evaluations'));
                    
                }
            },
            default => function () use ($user) {
                $project = Project::where('user_id', $user->id)->first();
                if ($project) {
                    return view('project.details');
                } else {
                    return view('project.register');
                }
            },
        };

        $view = $view();

        return $view;

    }
    public function project(Request $request)
{
    $user = Auth::user();
    
    $validatedData = $request->validate([
        'project_name' => ['required', 'string', 'max:255'],
        'project_category' => ['required', 'string', 'max:255'],
        'project_description' => ['required', 'string'],
        'keywords' => ['required', 'string', 'max:255'],
    ]);
    $validatedData['stall_location'] = 0;
    $validatedData['user_id'] = $user->id;

    
    
    // Create a new Project instance with the validated data
    $project = Project::create($validatedData);

    
    // return redirect()->route('project.details', ['id' => $project->id]);

    // Or simply return to the project view
    return view('project.details',compact('project'));
}
}
