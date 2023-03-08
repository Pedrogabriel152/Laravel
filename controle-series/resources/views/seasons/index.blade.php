<x-layout title="Temporadas de {!! $series->nome !!}">
   <div class="row">
    <div class="col">
        <a href="{{ route('series.index') }}" class="btn btn-dark mb-2">Voltar</a>
    </div>
   </div>
   <div class="row">
    <div class="col text-center">
        <img src="{{ asset('storage/'. $series->cover) }}" alt="Capa da série" class="img-fluid mt-3" style="height: 400px">
    </div>
   </div>
    <ul class="list-group">
        @foreach ($seasons as $season)

            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('episodes.index', $season->id) }}">
                    Temporada {{$season->number}}
                </a>

                <span class="badge bg-secondary">
                    {{$season->numberOfWatchedEpisodes()}} / {{$season->episodes->count()}}
                </span>
            </li>

        @endforeach
    </ul>
    
</x-layout >