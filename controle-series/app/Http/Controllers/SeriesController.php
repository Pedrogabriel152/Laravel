<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function index(Request $request) {
        $series = Series::query()->orderBy('nome')->get();
        $messagemDeSucesso = $request->session()->get('mensagem.sucesso');

        return view('series.index')->with('series', $series)
                                    ->with('messagemSucesso', $messagemDeSucesso);
    }

    public function create(Request $request) {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request) {
        $serie = DB::transaction(function () use ($request) {
            $serie = Series::create($request->all());

            $seasons = [];
            for($i = 1; $i <= intval($request->seasonsQty); $i++) {
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i,
                ];
            }
            
            Season::insert($seasons);
            $episodes = [];
            foreach ($serie->seasons as $season) {
                for ($j=1; $j <= $request->espisodesQty; $j++) { 
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }

            Episode::insert($episodes);

            return $serie;
        });
        

        return to_route('series.index')
                    ->with('mensagem.sucesso', "Serie '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series, Request $request) {
        $series->delete();

        return to_route('series.index')
                    ->with('mensagem.sucesso', "Serie '{$series->nome}' removida com sucesso");

    }

    public function update(SeriesFormRequest $request, Series $series) {
        $series->fill($request->all());
        $series->save();
        
        return to_route('series.index')
                    ->with('mensagem.sucesso', "Serie '{$series->nome}' atualizada com sucesso");
    }

    public function edit(Request $request, Series $series) {
        $seasons = $series->seasons()->with('episodes')->get();
        // dd(gettype($seasons[0]->episodes->count()));
        return view('series.edit')->with('serie', $series)->with('seasons',$seasons)->with('episodes', $seasons[0]->episodes->count());
    }
    
}
