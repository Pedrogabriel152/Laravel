<x-layout title="Editar Serie">
    <x-series.form :action="route('series.update', $serie->id)" :nome="$serie->nome" :seasons="$seasons->count()" :episodes="$episodes" :update="true"/>
</x-layout>