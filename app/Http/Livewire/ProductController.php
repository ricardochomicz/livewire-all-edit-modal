<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Collection;

class ProductController extends Component
{
    public $name, $price, $description, $category_id, $productId;
    public Collection $selectedProducts;
    public ?int $selectedCategory = null;
    public Collection $categories;
    public Collection $products;
    public bool $bulkDisabled = true;

    public function mount()
    {
        $this->categories = Category::all();
        $this->reloadData();
    }

    public function render()
    {
        $this->selectedCategory = $this->products
            ->filter(fn ($product) => $this->getSelectedProducts()->contains($product->id))
            ->map(fn ($product) => $product->category->id)
            ->unique()
            ->pipe(fn ($categories) => $categories->count() === 1 ? $categories->first() : null);

        $this->bulkDisabled = $this->selectedProducts->filter(fn ($p) => $p)->count() < 2;

        // $categories = Category::all();
        //$products = Product::latest('id')->take(10)->get();
        return view('livewire.product-controller');
    }

    public function create()
    {
        $categories = Category::all();
        return view('livewire.product-create', compact('categories'))->layout('layouts.app');
    }


    public function store()
    {
        $data = $this->validate();

        Product::updateOrCreate(['id' => $this->productId], $data);
        if ($this->productId) {
            toastr()->success('Produto atualizado com sucesso!');
        } else {
            toastr()->success('Produto cadastrado com sucesso!');
        }
        $this->name = "";
        $this->price = "";
        $this->category_id = "";
        $this->description = "";
        $this->reloadData();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->description = $product->description;
    }

    protected $rules = [
        'name' => 'required|min:3',
        'price' => 'required',
        'category_id' => 'required',
        'description' => 'nullable'
    ];

    protected $messages = [
        'name.required' => 'Informe o nome do produto',
        'name.min' => 'Minímo 3 caracteres',
        'price.required' => 'Informe o valor do produto',
        'category_id.required' => 'Selecione uma categoria'
    ];

    public function changeCategory()
    {
        Product::query()
            ->whereIn('id', $this->selectedProducts->filter(fn ($product) => $product)->keys()->toArray())
            ->update(['category_id' => $this->selectedCategory]);

        toastr()->info('Categorias dos produtos atualizadas com sucesso!');
        $this->reloadData();
    }

    public function reloadData()
    {
        $this->selectedCategory = null;
        $this->products = Product::with('category')->latest('id')->take(5)->get();
        $this->selectedProducts = $this->products
            ->map(fn ($product) => $product->id)
            ->flip()
            ->map(fn ($product) => false);
    }

    private function getSelectedProducts()
    {
        return $this->selectedProducts->filter(fn ($p) => $p)->keys();
    }
}
