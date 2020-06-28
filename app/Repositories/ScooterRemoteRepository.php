<?php

namespace App\Repositories;

use App\Exceptions\YegoConnectionException;
use App\Infraestructure\Repositories\RemoteRepository;

class ScooterRemoteRepository extends RemoteRepository
{
    /**
     * Retrieves rides from remote repository.
     *
     * @throws YegoConnectionException
     *
     * @return mixed
     */
    public function getScooters()
    {
        return $this->sendRequest('GET', 'api/v1/scooters/'. 1);
    }
}
