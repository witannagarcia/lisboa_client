@extends('layouts.menu')

@section('content')
    <div class="bar d-flex justify-content-between py-2">
        <div>
            <a href="{{ url('/menu?branch_id=' . $branch->id.'&table='.$table) }}" class="h4 text-white text-decoration-none">
                <i class="mdi mdi-chevron-left h5"></i> <span class="h5">Atras</span>
            </a>
        </div>
        <div>
            <h5 class="text-center text-center text-white poppins">{{ $category->name }}</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="imageBanner">
                <img src="{{ Storage::disk('public')->url($category->image_banner) }}" class="mw-100" alt="">
            </div>
        </div>
    </div>
    <hr class="b-primary">
    <div class="row mt-3">
        @if ($category->nodes()->exists())
            @foreach ($category->nodes as $cat)
                @if ($cat->dishes()->exists())
                    <p class="h5 text-white">{{ $cat->name }}</p>
                    @foreach ($cat->dishes as $dish)
                        <div class="col-6">
                            <a href="{{ url('/menu/platillo/' . $dish->id.'?branch_id='.$branch->id.'&table='.$table) }}" class="text-decoration-none">
                                <div class="card cardDish border-0 rounded-lg h-100">
                                    <div class="card-body p-0">
                                        <img src="{{ Storage::disk('public')->url($dish->image->url) }}" class="mw-100"
                                            alt="">
                                        <span class="badge badge-pill badge-primary">${{ $dish->price }}</span>
                                    </div>
                                    <div
                                        class="card-footer poppins h-100 text-center text-dark text-decoration-none d-flex justify-content-center align-items-center">
                                        {{ $dish->name }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            @endforeach
            @foreach ($category->dishes as $dish)
                <div class="col-6">
                    <a href="{{ url('/menu/platillo/' . $dish->id.'?branch_id='.$branch->id.'&table='.$table) }}" class="text-decoration-none">
                        <div class="card cardDish border-0 rounded-lg h-100">
                            <div class="card-body p-0">
                                <img src="{{ Storage::disk('public')->url($dish->image->url) }}" class="mw-100" alt="">
                                <span class="badge badge-pill badge-primary">${{ $dish->price }}</span>
                            </div>
                            <div
                                class="card-footer poppins h-100 text-center text-dark text-decoration-none d-flex justify-content-center align-items-center">
                                {{ $dish->name }}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            @foreach ($category->dishes as $dish)
                <div class="col-6">
                    <a href="{{ url('/menu/platillo/' . $dish->id.'?branch_id='.$branch->id.'&table='.$table) }}" class="text-decoration-none">
                        <div class="card cardDish border-0 rounded-lg h-100">
                            <div class="card-body p-0">
                                <img src="{{ Storage::disk('public')->url($dish->image->url) }}" class="mw-100" alt="">
                                <span class="badge badge-pill badge-primary">${{ $dish->price }}</span>
                            </div>
                            <div
                                class="card-footer poppins h-100 text-center text-dark text-decoration-none d-flex justify-content-center align-items-center">
                                {{ $dish->name }}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @endif


    </div>
@endsection
