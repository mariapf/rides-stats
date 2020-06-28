<?php

namespace App\Repositories;

use App\Entities\Ride;
use App\Infraestructure\Repositories\CoreRepository;

class RideRepository extends CoreRepository
{
    public function __construct(Ride $model)
    {
        parent::__construct($model);
    }
}
