<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EvaluationController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Evaluator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

Route::get('/', function () {
    return view('auth.login'); // Redirects to the login view when accessing the root URL
});

Route::get('/dashboard', function () {
    $projects = Project::all();
    
    return view('dashboard',compact('projects')); // Displays the dashboard view with all projects
})->middleware(['auth', 'verified'])->name('dashboard'); // Requires authentication and email verification for access

Route::view('/preferences', 'preferences.preferences')->name('preferences.preferences'); // Displays the preferences view

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Displays the profile edit view
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Updates user profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Deletes user profile
    Route::get('/project', [ProjectController::class, 'register'])->name('project.register'); // Displays project registration view
    Route::post('/project', [ProjectController::class, 'project'])->name('project'); // Creates a new project
    Route::put('/evaluation{id}', [EvaluationController::class, 'updateEvaluation'])->name('update_evaluation'); // Updates evaluation
    Route::get('/generate_evaluations', [EvaluationController::class, 'generateEvaluations'])->name('generate_evaluation'); // Generates evaluations

    // Updates evaluator preferences
    Route::post('/preferences-submit', function (Request $request) {
        $user = Auth::user(); // Get the authenticated user
        $curr_eval = $user->evaluator; // Get the evaluator associated with the user

        // Update preference for the authenticated evaluator
        $curr_eval->preferred_project_category .= ", " . $request->input('preference');
        $curr_eval->save();

        return view('preferences.preferences')->with('success', 'Data updated successfully!');
    })->name('preference.submit');

    // Updates evaluator keywords
    Route::post('/preferences', function (Request $request) {
        $user = Auth::user(); // Get the authenticated user
        $curr_eval = $user->evaluator; // Get the evaluator associated with the user

        // Update keywords for the authenticated evaluator
        $curr_eval->speciality .= ", " . $request->input('keyword');
        $curr_eval->save();

        return view('preferences.preferences')->with('success', 'Data updated successfully!');
    })->name('keyword.submit');
});

require __DIR__.'/auth.php'; // Include authentication routes
