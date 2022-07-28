<div>
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">Categorias</h4>
            <div class="row">
                <div class="col-sm-4">
                    <form wire:submit.prevent="store()">
                        <div class="form-group">
                            <label for="">Nome Categoria</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                wire:model="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary mt-3">Salvar</button>
                    </form>
                </div>

                <div class="col-sm-8">

                    <table class="table table-borderless table-hover mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Criado em</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($category->created_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm"
                                            wire:click="edit({{ $category->id }})">Editar</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Nenhuma categoria cadastrada!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
