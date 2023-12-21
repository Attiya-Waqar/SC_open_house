<!-- resources/views/project_details.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-3" style="background-color: #47a19f; color:snow; font-size: 1.2rem">{{ __('Project Details') }}</div>

                    <div class="card-body p-3">
                        <div class="card mb-4">
                            <div class="card-header" style="font-size: 1.15rem; background-color: #c1dedd"> {{ $project->project_name }} </div>
                            <div class="card-body p-3 mb-3">
                                <p><strong>Category:</strong> {{ $project->project_category }}</p>
                                <p><strong>Description:</strong> {{ $project->project_description }}</p>
                                <p><strong>Stall Location:</strong> {{ $project->stall_location }}</p>
                                <p><strong>Keywords:</strong> {{ $project->keywords }}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" style="font-size: 1.15rem; background-color: #c1dedd">{{ __('Evaluation') }}</div>
                            @foreach($evaluations as $evaluation)
                            <div class="card-body">
                                <p><strong>Evaluator Name:</strong> {{ $evaluation->evaluator->user->name }}</p>
                                <p><strong>Status:</strong> {{ $evaluation->project->is_evaluated ? 'Evaluated' : 'Not Evaluated' }}</p>
                            </div>
                            <hr>
                            @endforeach
                        </div> 
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
@endsection
