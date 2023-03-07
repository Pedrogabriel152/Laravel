<?php

namespace App\Listeners;

use App\Events\SeriesCreated;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SerieCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private SeriesRepository $repository,
        private SeriesFormRequest $request
    )
    {
        $this->repository = $repository->withoutRelations();
    }

    /**
     * Handle the event.
     */
    public function handle(SeriesCreated $event): void
    {
        $serie = $this->repository->add($this->request);
    }
}
