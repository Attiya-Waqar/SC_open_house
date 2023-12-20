@extends('layouts.app')

@php
    use App\Models\User;
    $userId = 3;  // get ID dynamically of current user
    $user = User::find($userId);
@endphp

<style> @import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap'); </style>

@section('content')
    <div class="container mt-4 text-center" style="color:ivory">
        <h1 class="display-4 mb-6" style="font-family: 'Dosis', sans-serif;"> Set Preferences & Keywords </h1>
        <!-- Add Preference -->
        <form method="POST" class="my-5" action="{{ route('preference.submit') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label mr-2" name="preference" id="preference">Add a Preference</label>
              <input type="text" class="text-dark"> <br>
              <button type="submit" class="btn mt-3 btn-secondary"> Add </button>
            </div>
        </form>
        <!-- Add Keyword -->
        <form method="POST" class="my-5" action="{{ route('keyword.submit') }}">
            @csrf
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label mr-2" name="keyword">Add a keyword</label>
              <input type="text" class="text-dark"> <br>
              <button type="submit" class="btn mt-3 btn-secondary"> Add </button>
            </div>
        </form>
    </div>
@endsection