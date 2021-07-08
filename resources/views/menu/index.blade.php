@extends('layouts.menu')

@section('content')
<h3 class="text-center text-white poppins">{{ $restaurant->name }}</h3>
<div class="row mb-2">
    @if(!is_null($table))
    <div class="col-6 text-white text-left">
        Mesa: {{ $table }}
    </div>
    <div class="col-6 text-white text-right">
        Sucursal: {{$branch->name}}
    </div>
    @else
    <div class="col-12 text-white text-center">
        Sucursal: {{$branch->name}}
    </div>
    @endif
</div>
    <div class="row">
        <div class="col-12">
            <img src="{{ asset('images/menu_banner_1.jpeg')}}" class="w-100" alt="">
        </div>
    </div>
    <h3 class="text-center text-white poppins">Menú</h3>
    <div class="row">        
            @foreach($branch->categories as $category)
                <div class="col-6 categoryBox rounded my-2">
                    <a href="{{ url('/menu/categoria/'.$category->id.'?branch_id='.$branch->id.'&table='.$table) }}">
                        <img src="{{ Storage::disk('public')->url($category->image_banner) }}" class="mw-100" alt="">
                        <span class="poppins">{{ $category->name }}</span> 
                    </a>                            
            </div>
            @endforeach    
</div>
@endsection