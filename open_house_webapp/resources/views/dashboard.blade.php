@extends('layouts.app')

@section('content')

    @php
        $proj = count($projects) - 1;
    @endphp

    <style> @import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap'); </style>
    <div >   
        <h1 class="display-5 mt-4 ml-4 text-center" style="color:ivory; font-family: 'Dosis', sans-serif;"> DASHBOARD 
        </h1>
    </div>

    <div class="container p-3 mb-5"style="">  
        @for ($i=0; $i<7; $i++)
        <div class="d-flex text-center container">
            @for ($j=0; $j<7; $j++)
               <div class="d-flex justify-content-center align-items-center container m-2 p-0" style="width:10vw; height:13vh; box-shadow: 0px 0px 0px lightgrey; border-radius: 1rem; background-color: ivory; color:navy">
                    <div>
                        <p> {{$projects[$proj]->project_name}} </br></p>
                        <p> {{$projects[$proj]->stall_location}} </p>
                    </div>
                    @php
                        $proj = $proj - 1;
                        if ($proj < 0)
                            break;
                    @endphp
                </div>
                @if ($i>0 && $i<6)
                    @break
                @endif
            @endfor
            @php
                if ($proj < 0)
                            break;
            @endphp
        </div>
        @endfor
    </div>
@endsection



