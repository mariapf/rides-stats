<?php

namespace Tests\Feature;

use App\Entities\Scooter;
use App\Services\Ride\RideService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class RidesCheckTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_list_of_scooters_can_be_retrieved()
    {
        //Given
        $scooter = factory(Scooter::class)->create(
            ['id' => 2,
            'lat' => 20,
            'lng' => 20,
            ]
        );

        $service = resolve(RideService::class);
        $rides   = $service->checkRides();

        $this->assertDatabaseHas('scooters',
            [
                'id' => $scooter->id,
            ]);
    }
}
