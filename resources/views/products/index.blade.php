@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
        <h1 class="text-center">Livewire Card Components</h1>

        <h2 class="text-center">⭐ Featured ⭐</h2>

        <div class="row row-cols-5 justify-content-center g-1 my-3">

            @foreach ($featured as $featuredProduct)
                <livewire:product-card-component :product="$featuredProduct" />
            @endforeach

        </div>

        <h2 class="text-center">Complete list</h2>

        <div class="row row-cols-5 justify-content-center g-1 my-3">

            @foreach ($products as $product)
                <livewire:product-card-component :product="$product" />
            @endforeach

        </div>

    </div>
@endsection
