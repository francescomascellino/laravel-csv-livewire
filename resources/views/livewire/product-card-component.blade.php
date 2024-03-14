<div class="col">

    <div class="card bg-dark text-light shadow h-100">

        <div class="position-relative">
            <img src="{{ $product['image'] }}" class="card-img-top" alt="...">
            <span class="position-absolute bottom-0 end-0 fw-bold m-2 price">{{ $product['price'] }} €</span>
        </div>

        <div class="card-body">
            <div class="d-flex align-items-center mb-1" style="height: 3rem">
                <h5 class="card-title">

                    {{ $product['name'] }}

                </h5>
            </div>

            <h6 class="card-subtitle mb-2  " style="color: {{ $product['category']['color'] }}">

                @if ($product['featured'])
                    <span>⭐</span>
                @endif

                {{ $product['category']['label'] }}

            </h6>

            <p class="card-text">{{ $product['description'] }}</p>

        </div>
    </div>

</div>
