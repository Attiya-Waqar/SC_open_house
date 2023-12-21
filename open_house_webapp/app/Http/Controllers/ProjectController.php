<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display the appropriate view based on user role and project status.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function register()
    {
        $user = Auth::user();

        $view = match ($user->role) {
            'admin' => function() {
                // Get all evaluations for admins
                $evaluations = Evaluation::all();
                return view('project.admin', compact('evaluations'));
            },
            'evaluator' => function () use ($user) {
                // Get evaluations for the logged-in evaluator
                $evaluations = Evaluation::where('evaluator_id', $user->id)->first();
                
                if (!$evaluations) {
                    return view('project.no_evaluations');
                } else {
                    // Get project details for the evaluator
                    $project = Project::where('id', $evaluations->project_id)->first();
                    $pageName = 'project';
                    return view('project.evaluations', compact('project', 'evaluations', 'pageName'));
                }
            },
            default => function () use ($user) {
                // Get project details for default users
                $project = Project::where('user_id', $user->id)->first();
                if ($project) {
                    $evaluations = Evaluation::where('project_id', $project->id)->get();
                    return view('project.details', compact('project', 'evaluations'));
                } else {
                    return view('project.register');
                }
            },
        };

        $view = $view();

        return $view;
    }

    /**
     * Handle project creation and redirect to project details view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function project(Request $request)
    {
        $user = Auth::user();
        
        // Validate the incoming request data
        $validatedData = $request->validate([
            'project_name' => ['required', 'string', 'max:255'],
            'project_category' => ['required', 'string', 'max:255'],
            'project_description' => ['required', 'string'],
            'keywords' => ['required', 'string', 'max:255'],
        ]);

        // Set default stall location and user ID
        $validatedData['stall_location'] = 0;
        $validatedData['user_id'] = $user->id;

        // Create a new Project instance with the validated data
        $project = Project::create($validatedData);

        // Retrieve evaluations related to the created project
        $evaluations = Evaluation::where('project_id', $project->id)->get();

        // Return the project details view with the created project and evaluations
        return view('project.details', compact('project', 'evaluations'));
    }
}
