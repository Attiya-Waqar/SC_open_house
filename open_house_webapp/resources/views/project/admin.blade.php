<!-- resources/views/project_details.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="card mb-4">
                    <div class="card-header p-3" style="background-color: #47a19f; color:snow; font-size: 1.2rem">{{ __('Create Evaluations:') }}</div>
                    <form method="get" action="/generate_evaluations">
                    <div class="card-body d-flex justify-content-center">
                        <button type='submit' class="btn btn-outline-secondary ">Generate Evaluations<button>
                    </div>
                    </form>
                </div>
                
                <div class="card">
                    <div class="card-header p-3" style="background-color: #47a19f; color:snow; font-size: 1.2rem">{{ __('Project Evaluations') }}</div>
                    @foreach($evaluations as $evaluation)
                    <div class="card-body">
                        <p><strong>Project Name:</strong> {{ $evaluation->project->project_name }}</p>
                        <p><strong>Evaluator Name:</strong> {{ $evaluation->evaluator->user->name }}</p>
                        <p><strong>Status:</strong> {{ $evaluation->project->is_evaluated ? 'Evaluated' : 'Not Evaluated' }}</p>
                    </div>
                    @endforeach

                </div>
                
            </div>
        </div>
    </div>
@endsection
