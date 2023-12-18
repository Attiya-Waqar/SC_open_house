<!-- resources/views/project_details.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Project Details') }}</div>

                    <div class="card-body">
                        <h2>{{ $project->project_name }}</h2>
                        
                        <p><strong>Category:</strong> {{ $project->project_category }}</p>
                        <p><strong>Description:</strong> {{ $project->project_description }}</p>
                        <p><strong>Stall Location:</strong> {{ $project->stall_location }}</p>
                        <p><strong>Keywords:</strong> {{ $project->keywords }}</p>

                        <!-- Add more details as needed -->

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
