<?php

namespace App\Http\Livewire\Adjustment;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Product\Entities\Product;

class ProductTable extends Component
{

    protected $listeners = ['productSelected'];

    public $products;
    public $hasAdjustments;

    public function mount($adjustedProducts = null) {
        $this->products = [];

        if ($adjustedProducts) {
            $this->hasAdjustments = true;
            $this->products = $adjustedProducts;
        } else {
            $this->hasAdjustments = false;
        }
    }

    public function render() {
        return view('livewire.adjustment.product-table');
    }

    public function productSelected($product) {
        switch ($this->hasAdjustments) {
            case true:
                if (in_array($product, array_map(function ($adjustment) {
                    return $adjustment['product'];
                }, $this->products))) {
                    return session()->flash('message', '¡Ya existe el producto en la lista!');
                }
                break;
            case false:
                if (in_array($product, $this->products)) {
                    return session()->flash('message', '¡Ya existe el producto en la lista!');
                }
                break;
            default:
                return session()->flash('message', '¡Algo salió mal!');
        }

        array_push($this->products, $product);
    }

    public function removeProduct($key) {
        unset($this->products[$key]);
    }
}
