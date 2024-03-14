@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-center">PRODUCTS INDEX</h1>

        <div class="row justify-content-center g-1">

            @foreach ($featured as $featuredProduct)
                <livewire:product-card-component :product="$featuredProduct" />
            @endforeach

        </div>

    </div>
@endsection
