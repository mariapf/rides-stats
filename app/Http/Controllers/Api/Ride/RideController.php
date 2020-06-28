<?php

namespace App\Http\Controllers\Api\Ride;

use App\Http\Requests\RideIndexRequest;
use App\Http\Resources\Ride as RideResource;
use App\Infraestructure\Controllers\BaseController;
use App\Repositories\RideRepository;
use Exception;
use Illuminate\Http\JsonResponse;

class RideController extends BaseController
{

    private $rideRepository;

    public function __construct(RideRepository $rideRepository)
    {
        $this->rideRepository = $rideRepository;
    }

    /**
     * @param RideIndexRequest $rideIndexRequest
     * @return JsonResponse
     */
    public function index(RideIndexRequest $rideIndexRequest)
    {

        try {

            /** @var Collection $rides */
            $rides = $this->rideRepository->findAll();

            return $this->sendResponse(RideResource::collection($rides), 'All rides result');
        } catch (Exception $controllerException) {
            return $this->sendError(trans($controllerException->getMessage()), $controllerException->getCode());
        }

    }
}
