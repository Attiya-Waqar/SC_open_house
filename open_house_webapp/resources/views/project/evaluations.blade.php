<!-- resources/views/project_details.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Evaluation Details') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update_evaluation', ['id' => $evaluations->id]) }}">
                            @csrf
                            @method('PUT')

                            <p><strong>Project Name:</strong> {{ $evaluations->project->project_name}}</p>
                            <p><strong>Evaluator Name:</strong> {{ $evaluations->evaluator->user->name }}</p>
                            <p><strong>Status:</strong> {{ $evaluations->is_evaluated ? 'Evaluated' : 'Not Evaluated' }}</p>
                            
                            <label for="score"><strong>Score:</strong></label>
                            <input type="number" id="score" name="score" value="{{ $evaluations->score }}" required>

                            <button type="submit" class="btn btn-outline-primary">Update Score</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
