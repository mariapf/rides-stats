<?php

namespace App\Services\Ride;

use App\Exceptions\YegoConnectionException;
use App\Infraestructure\Traits\HasDistance;
use App\Repositories\RideRepository;
use App\Repositories\ScooterRemoteRepository;
use App\Repositories\ScooterRepository;
use  Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class RideService
{
    use HasDistance;

    /** @var ScooterRemoteRepository */
    private $scooterRemoteRepository;

    /** @var ScooterRepository */
    private $scooterRepository;

    /** @var RideRepository */
    private $rideRepository;

    public function __construct(
        ScooterRemoteRepository $scooterRemoteRepository,
        ScooterRepository $scooterRepository,
        RideRepository $rideRepository
    ) {
        $this->scooterRemoteRepository = $scooterRemoteRepository;
        $this->scooterRepository       = $scooterRepository;
        $this->rideRepository          = $rideRepository;
    }

    /**
     * Reads scooters from remote service and store a new rides made for each scooter.
     *
     * @throws YegoConnectionException
     */
    public function checkRides(
    ): array {
        /** @var Collection $scooters */
        $remoteScooters = $this->scooterRemoteRepository->getScooters();

        Log::info(print_r($remoteScooters, true));
        // dd($remoteScooters);
        $rides = [];
        foreach ($remoteScooters as $remoteScooter) {
            $ride = $this->storeRide($remoteScooter);

            if ($ride) {
                $rides[] = $ride->toArray();
            }
            $this->scooterRepository->createOrUpdate(['id' => $remoteScooter['id']], $remoteScooter);
        }

        return $rides;
    }

    /**
     * Store a ride if distance is bigger than 60 meters from a previous stored ride.
     *
     * @param array $remoteScooter
     *
     * @return mixed
     */
    private function storeRide(array $remoteScooter)
    {
        if ($scooter = $this->scooterRepository->findLastById($remoteScooter['id'])) {
            $distance = $this->getDistance($scooter->lat, $scooter->lng, $remoteScooter['lat'], $remoteScooter['lng']);

            if ($distance > 60) {
                return $this->rideRepository->create(['scooter_id' => $scooter->id]);
            }
        }

        return false;
    }
}
