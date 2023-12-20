<!-- resources/views/project_details.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="card">
                    <div class="card-header">{{ __('Create Evaluations:') }}</div>
                    <form method="get" action="/generate_evaluations">
                    <div class="card-body d-flex justify-content-center">
                        <button type='submit' class="btn btn-outline-primary ">Generate Evaluations<button>
                    </div>
                    </form>
                </div>
                
                <div class="card">
                    <div class="card-header">{{ __('Project Evaluations') }}</div>
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
