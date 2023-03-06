<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodesRepository
{
    public static function update(Request $request, Season $season): null {
        return DB::transaction(function () use ($request, $season) {
            $watchedEpisodes = $request->episodes;
            $idUpdate = [];

            DB::update("update episodes set whatched = 0");
            if($watchedEpisodes) {
                foreach ($watchedEpisodes as $episode) {
                    $idUpdate[] = intval($episode);
                }
                $idUpdate = implode(',',$idUpdate);
                DB::update("update episodes set whatched = 1 where id in({$idUpdate})");
            }
            
        });
    }
}