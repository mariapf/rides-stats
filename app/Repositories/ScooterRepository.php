<?php

namespace App\Repositories;

use App\Entities\Scooter;
use App\Infraestructure\Repositories\CoreRepository;

class ScooterRepository extends CoreRepository
{
    public function __construct(Scooter $model)
    {
        parent::__construct($model);
    }
}
