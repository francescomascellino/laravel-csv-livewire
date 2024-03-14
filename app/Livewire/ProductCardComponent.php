<?php

namespace App\Livewire;

use Livewire\Component;

class ProductCardComponent extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.product-card-component', [
            'products' => $this->product
        ]);
    }
}
