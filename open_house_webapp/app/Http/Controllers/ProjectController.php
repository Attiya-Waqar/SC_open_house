<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function register()
    {

        return view('project.register');
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
