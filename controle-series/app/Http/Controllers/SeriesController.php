<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index(Request $request) {
        $series = Serie::query()->orderBy('nome')->get();
        $messagemDeSucesso = $request->session('mensagem.sucesso');

        return view('series.index')->with('series', $series)
                                    ->with('messagemSucesso', $messagemDeSucesso);
    }

    public function create(Request $request) {
        return view('series.create');
    }

    public function store(Request $request) {
        $serie = Serie::create($request->all());

        $request->session()->flash('mensagem.sucesso', "Serie '{$serie->nome}' adicionada com sucesso");

        return to_route('series.index');
    }

    public function destroy(Serie $series, Request $request) {
        $series->delete();
        $request->session()->flash('mensagem.sucesso', "Serie '{$series->nome}' removida com sucesso");

        return to_route('series.index');

    }
}
