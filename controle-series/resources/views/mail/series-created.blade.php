@component('mail::message')

# {{$nomeSerie}}

A série {{$nomeSerie}} com {{$qtdTemporadas}} temporadas e {{$qtdEspisodios}} eps por temporadas foi criada.

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $idSerie)])
    Ver serie
@endcomponent

@endcomponent