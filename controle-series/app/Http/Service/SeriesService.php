<?php

namespace App\Http\Service;

use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;
use App\Events\SeriesCreated as SeriesCreatedEvent;

class SeriesService {

    public function __construct(
        
    ){}

    public static function store(
        SeriesFormRequest $request, 
        SeriesRepository $repository
    ) {

        $serie = $repository->add($request);
        
        SeriesCreatedEvent::dispatch(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->espisodesQty
        );
    }
}
