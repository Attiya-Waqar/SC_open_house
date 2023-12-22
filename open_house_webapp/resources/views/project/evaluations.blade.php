<!-- resources/views/project_details.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-3" style="background-color: #47a19f; color:snow; font-size: 1.2rem">{{ __('Evaluation Details') }}</div>

                    <div class="card-body">
                        @foreach($evaluations as $evaluation)
                        @php
                        
                        @endphp
                        <form method="POST" action="{{ route('update_evaluation', ['id' =>  $evaluation->id]) }}" class='mb-5'>
                            @csrf
                            @method('PUT')

                            <p><strong>Project Name:</strong> {{ $evaluation->project->project_name}}</p>
                            <p><strong>Evaluator Name:</strong> {{ $evaluation->evaluator->user->name }}</p>
                            <p><strong>Status:</strong> {{ $evaluation->is_evaluated ? 'Evaluated' : 'Not Evaluated' }}</p>
                            
                            <label for="score"><strong>Score:</strong></label>
                            <input type="number" id="score" name="score" value="{{ $evaluation->score }}" class="p-1 rounded" required>

                            <button type="submit" class="btn btn-outline-primary">Update Score</button>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
