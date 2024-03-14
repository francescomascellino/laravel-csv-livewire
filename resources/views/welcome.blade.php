@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            
            <h1 class="text-center">SECTION CONTENT</h1>

            <div class="col ">
                <a href="{{ route('products.index') }}">Indice dei prodotti</a>
            </div>

        </div>
    </div>
@endsection
