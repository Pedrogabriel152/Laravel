<x-layout title="Nova Serie">
    <form action="{{ route('series.update', $serie->id) }}" method="post">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{$serie->nome}}">
        </div>

        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
</x-layout>