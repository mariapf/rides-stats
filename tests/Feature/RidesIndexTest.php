<?php

namespace Tests\Feature;

use App\Entities\Ride;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @coversNothing
 */
class RidesIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_200_is_returned_when_retrieving_the_list_of_rides()
    {
        //Given

        $ride = factory(Ride::class)->create();

        //When
        $response = $this->get(route('ride.index'));

        //Then
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                'scooter_id' => $ride->scooter_id
            ]);
    }
}
