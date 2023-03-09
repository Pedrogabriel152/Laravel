<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use App\Http\Requests\SeriesFormRequest;

class SeriesRepository
{
    public function add(object $data): Series {
        return DB::transaction(function () use ($data) {
            $serie = Series::create([
                'nome' => $data->nome,
                'cover' => $data->coverPath
            ]);

            $seasons = [];
            for($i = 1; $i <= intval($data->seasonsQty); $i++) {
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i,
                ];
            }
            
            Season::insert($seasons);
            $episodes = [];
            foreach ($serie->seasons as $season) {
                for ($j=1; $j <= $data->espisodesQty; $j++) { 
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }

            Episode::insert($episodes);

            return $serie;
        });
    }
}