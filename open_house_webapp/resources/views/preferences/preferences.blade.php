@extends('layouts.app')

<style> @import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap'); </style>


@section('content')
    <div class="container">
        <div class="row justify-content-center text-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-3" style="background-color: #47a19f; color:snow; font-size: 1.2rem">{{ __('Project Registration') }}</div>

                    <div class="card-body">
                        <!-- Add Preference -->
                        <form method="POST" class="my-2" action="{{ route('preference.submit') }}">
                            @csrf
                            <div class="mb-3">
                              <label class="form-label mr-2" name="preference" id="preference">Add a Preference</label><br>
                              <input type="text" class="text-dark" name="preference" id="preference"> <br>
                              <button type="submit" class="btn mt-3 btn-outline-secondary"> Add </button>
                        </form>
                    </div>

                    <!-- Add Keyword -->
                    <form method="POST" class="my-5" action="{{ route('keyword.submit') }}">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label mr-2" name="preference" id="preference">Add a Keyword</label><br>
                              <input type="text" class="text-dark" name="keyword" id="keyword"> <br>
                              <button type="submit" class="btn mt-3 btn-outline-secondary"> Add </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection