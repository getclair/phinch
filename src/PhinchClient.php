<?php

namespace Phinch;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PhinchClient
{
    /**
     * @var string
     */
    protected static string $base_uri = 'https://api.tryfinch.com';

    /**
     * @var Client
     */
    protected Client $client;


    /**
     * @var string|null
     */
    protected string|null $token = null;

    /**
     * FinchClient constructor.
     *
     * @param string $api_version
     */
    public function __construct(protected string $api_version)
    {
        $this->client = new Client([
            'base_uri' => self::$base_uri,
        ]);
    }

    /**
     * Make GET request.
     *
     * @param $path
     * @param array $query
     *
     * @return array
     * @throws GuzzleException
     */
    public function get($path, array $query = []): array
    {
        return $this->request('get', $path, $query);
    }

    /**
     * Make POST request.
     *
     * @param $path
     * @param array $params
     *
     * @return array
     * @throws GuzzleException
     */
    public function post($path, array $params = []): array
    {
        return $this->request('post', $path, $params);
    }

    /**
     * Make PUT request.
     *
     * @param $path
     * @param array $params
     *
     * @return array
     * @throws GuzzleException
     */
    public function put($path, array $params = []): array
    {
        return $this->request('put', $path, $params);
    }

    /**
     * Make DELETE request.
     *
     * @param $path
     *
     * @return array
     * @throws GuzzleException
     */
    public function delete($path): array
    {
        return $this->request('delete', $path);
    }

    /**
     * @param $method
     * @param $path
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    public function request($method, $path, array $data = []): array
    {
        if(! $this->token) {
            throw new \Exception("A valid access token must be provided.");
        }

        $method = strtoupper($method);

        $key = $method === 'GET' ? 'query' : 'json';

        $request = $this->client->request($method, $path, [
            $key => $data,
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
                'Finch-API-Version' => $this->apiVersion(),
            ],
            'http_errors' => false,
        ]);

//        dd($request->getBody());

        return json_decode($request->getBody(), true);
    }

    /**
     * @param string $token
     * @return $this
     */
    public function authorize(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function apiVersion(): string
    {
        return $this->api_version;
    }
}
