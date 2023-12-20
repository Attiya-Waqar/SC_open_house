@extends('layouts.app')

@section('content')

    @php
        $proj = 0;
    @endphp

    <div >   
        <h1 class="display-5 mt-4 ml-4" style="color:ivory"> DASHBOARD 
        </h1>
    </div>

    <div class="container p-3 mb-5"style="">  
        @for ($i=0; $i<7; $i++)
        <div class="d-flex text-center container">
            @for ($j=0; $j<7; $j++)
               <div class="d-flex justify-content-center align-items-center container m-2 p-0" style="width:10vw; height:10vh; box-shadow: 0px 0px 0px lightgrey; border-radius: 1rem; background-color: #212735; color:#6ef8f1">
                    <div>
                        <p> Project Name </br></p>
                        <p> Location </p>
                    </div>
                </div>
                @if ($i>0 && $i<6)
                    @break
                @endif
            @endfor
        </div>
        @endfor
    </div>
@endsection



