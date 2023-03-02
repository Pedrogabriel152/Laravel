<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Serie;
use App\Http\Requests\SeriesFormRequest;

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

    public function store(SeriesFormRequest $request) {
        $serie = Serie::create($request->all());

        return to_route('series.index')
                    ->with('mensagem.sucesso', "Serie '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy(Serie $series, Request $request) {
        $series->delete();

        return to_route('series.index')
                    ->with('mensagem.sucesso', "Serie '{$series->nome}' removida com sucesso");

    }

    public function update(SeriesFormRequest $request, Serie $series) {
        $series->fill($request->all());
        $series->save();
        
        return to_route('series.index')
                    ->with('mensagem.sucesso', "Serie '{$series->nome}' atualizada com sucesso");
    }

    public function edit(Request $request, Serie $series) {
        return view('series.edit')->with('serie', $series);
    }
    
}
