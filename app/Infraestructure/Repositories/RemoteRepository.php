<?php

namespace App\Infraestructure\Repositories;

use App\Exceptions\YegoConnectionException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RemoteRepository
{
    /**
     * @var Client
     */
    private $client;

    /**
     * RemoteRepository constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Resolve HTTP API requests.
     *
     * @param string $method
     * @param string $uri
     * @param array  $data
     *
     * @throws YegoConnectionException
     *
     * @return mixed
     */
    public function sendRequest(
        string $method,
        string $uri,
        array $data = []
    ) {
        /** @var array $options */
        $options = [
            'base_uri' => config('yego.scooters.service_url'),
            'json'     => $data,
            'headers'  => [
                'Authorization' => 'Bearer '.config('yego.scooters.service_token'),
                'Accept'        => 'application/json',
            ],
        ];

        try {
            $response = $this->client->request($method, $uri, $options);

            return json_decode((string) $response->getBody()->getContents(), true);
        } catch (GuzzleException $guzzleException) {
            throw new YegoConnectionException($guzzleException->getMessage());
        }
    }
}
