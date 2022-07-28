<div class="card text-left">
    <div class="card-body">
        <h4 class="card-title">Produtos</h4>
        <form wire:submit.prevent="store()">
            <div class="form-group">
                <label for="">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="">Valor</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" wire:model="price">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-sm-6">
                    <label for="">Categoria</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" wire:model="category_id">
                        <option value="">Selecione a categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="">Descrição</label>
                <input type="text" class="form-control" wire:model="description">
            </div>
            <button class="btn btn-primary mt-3">Salvar</button>
        </form>


        <table class="table table-borderless table-hover mt-3">
            <thead>
                <tr>
                    <th></th>
                    <th>Produto</th>
                    <th>Valor</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            <input type="checkbox" wire:model="selectedProducts.{{ $product->id }}">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>R$ {{ number_format($product->price, 2, ',','.') }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm"
                                            wire:click="edit({{ $product->id }})">Editar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            Nenhum produto cadastrado!
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <button data-bs-toggle="modal" data-bs-target="#categories-modal" class="btn btn-success {{ $bulkDisabled ? 'disabled' : null }}">Atualizar
            Categorias</button>
            
                
            
            
    </div>
    <div wire:ignore id="categories-modal" class="modal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Categorias</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select wire:model.defer="selectedCategory" class="form-control">
                        
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="changeCategory"
                    wire:loading.attr="disabled">
                        Atualizar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
