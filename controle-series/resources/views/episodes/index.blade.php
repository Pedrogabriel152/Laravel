<x-layout title="Episódios">
    <a href="{{route('seasons.index', $season)}}"" class="btn btn-dark mb-2">Voltar</a>
    @isset($messagemSucesso)
        <div class="alert alert-success">
            {{$messagemSucesso}}
        </div>
    @endisset
    <form method="post">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{$episode->number}}
                    <input type="checkbox" 
                        name="episodes[]" 
                        value="{{$episode->id}}"
                        @if ($episode->whatched) checked @endif
                    />
                </li>
            @endforeach
        </ul>
        
        <button class="btn btn-primary mt-2 mb-2" type="submit">Salvar</button>
    </form>

</x-layout >