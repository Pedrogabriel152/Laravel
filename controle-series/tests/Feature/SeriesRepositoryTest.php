<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesRepositoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_when_a_series_is_created_its_seasons_and_episodes_must_also_be_created(): void
    {
        //Arrange
        /** @var SeriesRepository $repository */
        $repository = $this->app->make(SeriesRepository::class);

        $request = new SeriesFormRequest();
        $request->nome = 'Nome da série';
        $request->seasonsQty = 1;
        $request->episodesQty = 2;

        //Act
        $repository->add($request);

        //Assert
        $this->assertDatabaseHas('series',['nome' => $request->nome]);
        $this->assertDatabaseHas('seasons',['number' => 1]);
        $this->assertDatabaseHas('episodes',['number' => 2]);
    }
}
