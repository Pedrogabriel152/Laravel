<form action="{{ $action }}" method="post">
    @csrf

    @if($update)
    @method('PUT')
    @endif
    <div class="row mb-3">
        <div class="col-8 mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" 
                    autofocus
                    name="nome" 
                    id="nome" 
                    class="form-control" 
                    @isset($nome) value="{{$nome}}" @endisset
            >
        </div>
        <div class="col-2 mb-3">
            <label for="seasonsQty" class="form-label">N° Temporadas:</label>
            <input type="text" 
                    name="seasonsQty" 
                    id="seasonsQty" 
                    class="form-control" 
                    @isset($seasons) value="{{$seasons}}" @endisset
            >
        </div>
        <div class="col-2 mb-3">
            <label for="espisodesQty" class="form-label">N° Episodios:</label>
            <input type="text" 
                    name="espisodesQty" 
                    id="espisodesQty" 
                    class="form-control" 
                    @isset($episodes) 
                        value="{{$episodes}}"
                    @endisset
            >
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>