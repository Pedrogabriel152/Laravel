<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Repositories\EpisodesRepository;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodesController 
{
    public function index(Season $season, Request $request) {
        $messagemDeSucesso = $request->session()->get('mensagem.sucesso');
        return view('episodes.index', ['episodes' => $season->episodes, 'messagemSucesso'=>$messagemDeSucesso, 'season'=>$season->series_id]);
    }

    public function update(Request $request, Season $season) {
        EpisodesRepository::update($request, $season);

        return to_route('episodes.index', $season->id)
                        ->with('mensagem.sucesso', "Episódio alterado com sucesso");
    }
}