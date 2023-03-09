<?php

namespace App\Http\Controllers\Api;

use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;

class SeriesControllerApi extends Controller
{

    public function __construct(private SeriesRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Series::query();
        if($request->has('nome')) {
            $query->where('nome', $request->nome);
        }

        return $query->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeriesFormRequest $request)
    {
        $nome = $request->nome;
        $seasonsQty = $request->seasonsQty;
        $espisodesQty = $request->espisodesQty;
        $coverPath = $request->coverPath? $request->coverPath : null;

        if(!$seasonsQty) {
            return response()->json(["message" => "O número de temporadas é obrigatório"], 402);
        }

        if(!$nome) {
            return response()->json(["message" => "O nome é obrigatório"], 402);
        }

        if(!$espisodesQty) {
            return response()->json(["message" => "O número de episodios é obrigatório"], 402);
        }

        $data = new \stdClass;
        $data->nome = $nome;
        $data->seasonsQty = $seasonsQty;
        $data->espisodesQty = $espisodesQty;
        $data->coverPath = $coverPath;

        $serie = $this->repository->add($data);

        return response()->json($serie, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $serie = Series::whereId($id)->with('seasons.episodes')->first();

        return $serie;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return $series;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $series)
    {
        Series::destroy($series);

        return response()->noContent();
    }
}
