<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Series;
use App\Models\Episode;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    public function series(){
        return $this->belongsTo(Series::class);
    }

    public function episodes(){
        return $this->hasMany(Episode::class);
    }

    public function numberOfWatchedEpisodes(): int{
        return $this->episodes->filter(fn ($episode) => $episode->whatched)->count();
    }
}
