<x-layout title="Series">
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
    @isset($messagemSucesso)
        <div class="alert alert-success">
            {{$messagemSucesso}}
        </div>
    @endisset
    <ul class="list-group">
        @foreach ($series as $serie)

            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $serie->nome }}

                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary btn-sm m-1" href="{{ route('series.edit', $serie->id)}}"><i class="bi bi-pencil-square"></i></a>
                    
                    <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm m-1" type="submit"><i class="bi bi-trash3-fill"></i></button>
                    </form>
                </div>
            </li>

        @endforeach
    </ul>
    
</x-layout >