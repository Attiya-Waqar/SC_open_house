@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Project Registration') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('project.register') }}">
                            @csrf

                            <!-- Project Name -->
                            <div class="mb-3">
                                <label for="project_name" class="form-label">{{ __('Project Name') }}</label>
                                <input type="text" class="form-control" id="project_name" name="project_name" required>
                            </div>

                            <!-- Project Category -->
                            <div class="mb-3">
                                <label for="project_category" class="form-label">{{ __('Project Category') }}</label>
                                <input type="text" class="form-control" id="project_category" name="project_category" required>
                            </div>

                            <!-- Project Description -->
                            <div class="mb-3">
                                <label for="project_description" class="form-label">{{ __('Project Description') }}</label>
                                <textarea class="form-control" id="project_description" name="project_description" rows="4" required></textarea>
                            </div>

                            <!-- Keywords -->
                            <div class="mb-3">
                                <label for="keywords" class="form-label">{{ __('Keywords') }}</label>
                                <input type="text" class="form-control" id="keywords" name="keywords" required>
                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-outline-primary">{{ __('Register Project') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
