<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use App\Models\User;
use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use App\Http\Middleware\Atenticador;
use App\Mail\SeriesCreated;

class SeriesController extends Controller
{
    public function __construct() {
        $this->middleware(Atenticador::class)->except('index');
    }

    public function index(Request $request) {
        $series = Series::query()->orderBy('nome')->get();
        $messagemDeSucesso = $request->session()->get('mensagem.sucesso');

        return view('series.index')->with('series', $series)
                                    ->with('messagemSucesso', $messagemDeSucesso);
    }

    public function create(Request $request) {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, SeriesRepository $repository) {
       
        $serie = $repository->add($request);

        // Mail::to($request->user())->send($email);
        $moreUsers = User::all();

        foreach($moreUsers as $index => $user){

            $email = new SeriesCreated(
                $serie->nome,
                $serie->id,
                $request->seasonsQty,
                $request->espisodesQty
            );
            
            $when = now()->addSeconds($index * 5);

            Mail::to($user)
            ->later($when ,$email);
        }
        

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
