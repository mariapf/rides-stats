<?php

namespace App\Console\Commands;

use App\Exceptions\YegoConnectionException;
use App\Services\Ride\RideService;
use Illuminate\Console\Command;

class CheckRides extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:rides';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reads the list of scooters and stores when a new ride is made';

    /** @var RideService */
    private $rideService;

    /**
     * Create a new command instance.
     *
     * @param RideService $rideService
     */
    public function __construct(RideService $rideService)
    {
        parent::__construct();

        $this->rideService = $rideService;
    }

    /**
     * Execute the console command.
     *
     * @throws YegoConnectionException
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Reading scooters');
        $rides = $this->rideService->checkRides();
        $this->info('Rides made: '.print_r($rides));
    }
}
