@extends('layouts.app')

@section('content')

    @php
        $proj = count($projects) - 1;
        
    @endphp

    <style> @import url('https://fonts.googleapis.com/css2?family=Dosis&display=swap'); </style>
    <div >   
        <h1 class="display-5 mt-4 ml-4 text-center" style="color:black;"> Placement Plan 
        </h1>
    </div>

    <div class="container p-3 mb-5"style="">  
        
        @if(!(count($projects) === 0))

        @for ($i=0; $i<7; $i++)
        <div class="d-flex text-center container">
            @for ($j=0; $j<7; $j++)
               <div class="d-flex justify-content-center align-items-center container m-2 p-0" style="width:12vw; height:10vh; box-shadow: 0px 0px 0px lightgrey; border-radius: 1rem; background-color: lightgrey; color:#47a19f; font-weight: 1000; border:0.65px solid #47a19f">
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
        @else
        <p>NO PROJECTS</p>
        @endif
    </div>

@endsection



