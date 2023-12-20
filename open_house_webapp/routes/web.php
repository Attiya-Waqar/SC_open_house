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
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $projects = Project::all();
    
    return view('dashboard',compact('projects'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('/preferences', 'preferences.preferences')->name('preferences.preferences');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/project', [ProjectController::class, 'register'])->name('project.register');
    Route::post('/project', [ProjectController::class, 'project'])->name('project');
    Route::put('/evaluation{id}', [EvaluationController::class, 'updateEvaluation'])->name('update_evaluation');
    Route::get('/generate_evaluations', [EvaluationController::class, 'generateEvaluations'])->name('generate_evaluation');
    Route::post('/preferences-submit', function (Request $request) 
    {
        $evaluators = Evaluator::all();
        $user = Auth::user(); // Get the authenticated user
        $curr_eval = $user->evaluator;
        // Update preference for the authenticated evaluator
    
        $curr_eval->preferred_project_category = $request->input('preference');
        $curr_eval->save();

        return view('preferences.preferences')->with('success', 'Data updated successfully!');
    })->name('preference.submit');

    Route::post('/preferences', function (Request $request) 
    {
        $user = Auth::user(); // Get the authenticated user      
        $user->preferred_project_category = $request->input('keyword');
        
        return view('preferences.preferences')->with('success', 'Data updated successfully!');
    })->name('keyword.submit');
});

require __DIR__.'/auth.php';
