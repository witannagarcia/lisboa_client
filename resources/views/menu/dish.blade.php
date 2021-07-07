@extends('layouts.menu')

@section('content')
<div class="bar d-flex justify-content-between py-2">
    <div >
        <a href="{{ url('/menu/categoria/'.$dish->category_id.'?table='.$table) }}" class="h4 text-white text-decoration-none">
            <i class="mdi mdi-chevron-left h5"></i> <span class="h5">Atras</span>
        </a>
    </div>
    <div>
        <h5 class="text-center text-center text-white poppins">{{ $dish->name }}</h5>
    </div>
</div>
    <div class="row">        
        <div class="col-sm-12">
            <div class="imageBanner">
                @if($dish->images()->exists())
                @foreach ($dish->images as $image)
                <img src="{{ Storage::disk('public')->url($image->url) }}" class="mw-100" alt="">                    
                @endforeach
                @else
                @endif
            </div>
        </div>       
</div>
<hr class="b-primary">
<div class="row">
    <div class="col-sm-12">
        <table class="table text-white border-0">
            <tbody>
                <tr>
                    <td class="border-0">Precio</td>
                    <td class="border-0 text-right font-weight-bold">${{$dish->price}}</td>
                </tr>
                <tr>
                    <td class="border-0">Tiempo de preparación</td>
                    <td class="border-0 text-right font-weight-bold">{{$dish->preparation_time}} mins.</td>
                </tr>
                <tr>
                    <td colspan="2" class="border-0">{{ $dish->description }}</td>
                </tr>
                @if(!is_null($table))
                <tr>
                    <td colspan="2" class="border-0 text-center">
                        <a class="btn btn-primary rounded-pill showInstructionsModal">Agregar a la orden</a>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="row mt-2">
    <div class="col-sm-12">
        <span class="h5 poppins text-white">Platillos similares</span>
        <div class="row mt-2">
            @foreach($similars as $similar)
    <div class="col-6">
        <a href="{{ url('/menu/platillo/'.$similar->id.'?table='.$table) }}" class="text-decoration-none">
            <div class="card cardDish border-0 rounded-lg h-100">
                <div class="card-body p-0">
                    <img src="{{ Storage::disk('public')->url($similar->image->url) }}" class="mw-100" alt="">
                    <span class="badge badge-pill badge-primary">${{ $similar->price }}</span>
                </div>
                <div class="card-footer poppins h-100 text-center text-dark text-decoration-none d-flex justify-content-center align-items-center">
                    {{ $similar->name }}
                </div>
            </div>
        </a>
    </div>
    @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).on('click', '.showInstructionsModal', function(){
        $('#specialInstructionsModal form input[name="dish_id"]').val("{{ $dish->id }}")
        $('#specialInstructionsModal').modal('show');
    })
    $(document).ready(function(){
        $('.imageBanner').slick({
            dots: true,
  infinite: true,
  autoplay: true,
  autoplaySpeed: 5000,
        });
    })
</script>
@endsection