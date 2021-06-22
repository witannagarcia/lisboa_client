@extends('layouts.menu')

@section('content')
<h3 class="text-center text-white poppins">{{ $restaurant->name }}</h3>
    <div class="row">
        <div class="col-12">
            <img src="{{ asset('images/menu_banner_1.jpeg')}}" class="w-100" alt="">
        </div>
    </div>
    <h3 class="text-center text-white poppins">Menú</h3>
    <div class="row">        
            @foreach($restaurant->categories as $category)
                <div class="col-6 categoryBox rounded my-2">
                    <a href="{{ url('/menu/categoria/'.$category->id) }}">
                        <img src="{{ $category->image_banner}}" class="mw-100" alt="">
                        <span class="poppins">{{ $category->name }}</span> 
                    </a>                            
            </div>
            @endforeach    
</div>
@endsection