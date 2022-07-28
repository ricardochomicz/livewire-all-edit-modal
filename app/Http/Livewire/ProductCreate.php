<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductCreate extends Component
{
    public $name, $price, $description, $category;
    public function render()
    {
        $categories = Category::all();
        return view('livewire.product-create', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('livewire.product-create', compact('categories'));
    }

    public function store()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category,
            'description' => $this->description
        ]);
    }

    protected $rules = [
        'name' => 'required|min:3',
        'price' => 'required',
        'category' => 'required'
    ];

    protected $messages = [
        'name.required' => 'Informe o nome do produto',
        'name.min' => 'Minímo 3 caracteres',
        'price.required' => 'Informe o valor do produto',
        'category.required' => 'Selecione uma categoria'
    ];
}
