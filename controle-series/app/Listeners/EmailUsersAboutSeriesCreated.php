<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Models\User;
use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SeriesCreatedEvent $event): void
    {
        $moreUsers = User::all();

        foreach($moreUsers as $index => $user){

            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seriesSeasonsQty,
                $event->seriesEspisodesQty
            );
            
            $when = now()->addSeconds($index * 5);

            Mail::to($user)
            ->later($when ,$email);
        }
    }
}
