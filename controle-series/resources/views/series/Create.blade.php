<x-layout title="Criar Serie">
    <x-series.form :action="route('series.store')" :nome="old('nome')" :update="false" />
</x-layout>