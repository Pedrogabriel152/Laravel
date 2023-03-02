<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index(Request $request) {
        $series = Serie::query()->orderBy('nome')->get();
        $messagemDeSucesso = $request->session()->get('mensagem.sucesso');

        return view('series.index')->with('series', $series)
                                    ->with('messagemSucesso', $messagemDeSucesso);
    }

    public function create(Request $request) {
        return view('series.create');
    }

    public function store(Request $request) {
        $serie = Serie::create($request->all());

        return to_route('series.index')
                    ->with('mensagem.sucesso', "Serie '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy(Serie $series, Request $request) {
        $series->delete();

        return to_route('series.index')
                    ->with('mensagem.sucesso', "Serie '{$series->nome}' removida com sucesso");

    }

    public function update(Request $request, Serie $series) {
        $series->nome = $request->nome;
        $series->save();
        
        return to_route('series.index')
                    ->with('mensagem.sucesso', "Serie '{$series->nome}' atualizada com sucesso");
    }

    public function edit(Request $request, Serie $series) {
        return view('series.edit')->with('serie', $series);
    }
}
