<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index(Request $req) {
        $series = Serie::query()->orderBy('nome')->get();

        return view('series.index', compact('series'));
    }

    public function create(Request $req) {
        return view('series.create');
    }

    public function save(Request $request) {
        $nomeSerie = $request->input('name');

        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save();

        return redirect('/series');

    }
}
