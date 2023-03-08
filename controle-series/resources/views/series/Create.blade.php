<x-layout title="Criar Serie">
    <form action="{{route('series.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-8 mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" 
                        autofocus
                        name="nome" 
                        id="nome" 
                        class="form-control" 
                        value="{{old("nome")}}" 
                >
            </div>
            <div class="col-2 mb-3">
                <label for="seasonsQty" class="form-label">N° Temporadas:</label>
                <input type="text" 
                        name="seasonsQty" 
                        id="seasonsQty" 
                        class="form-control" 
                        value="{{old('seasonsQty')}}"
                >
            </div>
            <div class="col-2 mb-3">
                <label for="espisodesQty" class="form-label">N° Episodios:</label>
                <input type="text" 
                        name="espisodesQty" 
                        id="espisodesQty" 
                        class="form-control" 
                        value="{{old('episodesQty')}}"
                >
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label for="cover" class="form-label">Capa:</label>
                <input type="file" id="cover" name="cover" class="form-control">
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary" accept="image/png,image/jpeg">Adicionar</button>
    </form>
</x-layout>