<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryController extends Component
{
    public $name, $categoryId;

    public function render()
    {
        $categories = Category::latest('id')->take(10)->get();
        return view('livewire.category-controller', compact('categories'));
    }

    public function create()
    {
        return view('livewire.category-create')->layout('layouts.app');
    }

    public function store()
    {
        $data = $this->validate();
        try {
            Category::updateOrCreate(['id' => $this->categoryId], $data);
            $this->reset();
            if ($this->categoryId) {
                toastr()->success('Categoria atualizada com sucesso');
            }
            toastr()->success('Categoria cadastrada com sucesso');
        } catch (\Throwable $th) {
            toastr()->error('Erro ao cadastrar categoria');
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
    }

    protected $rules = [
        'name' => 'required|min:3'
    ];

    protected $messages = [
        'name.required' => 'Informe o nome da categoria',
        'name.min' => 'Minímo 3 caracteres'
    ];
}
