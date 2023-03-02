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

    public function store(Request $request) {
        $nomeSerie = $request->name;

        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save();

        return to_route('series.index');

    }
}
