<?php

namespace Phinch;

use GuzzleHttp\Client;

class FinchClient
{
    protected const BASE_URI = 'https://api.tryfinch.com';

    protected Client $client;

    protected string $api_version;
    protected string $redirect_uri;

    public function __construct($client_id, $client_secret, $api_version, $redirect_uri)
    {
        $this->api_version = $api_version;
        $this->redirect_uri = $redirect_uri;

        $credentials = base64_encode("{$client_id}:{$client_secret}");

        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'headers' => [
                'Authorization' => "Basic {$credentials}",
                'Finch-API-Version' => $api_version,
            ],
        ]);
    }

    public function get($path, array $query = [], array $headers = []): array
    {
        return $this->request('get', $path, $query, $headers);
    }

    public function post($path, array $params = [], array $headers = []): array
    {
        return $this->request('post', $path, $params, $headers);
    }

    public function put($path, array $params = [], array $headers = []): array
    {
        return $this->request('put', $path, $params, $headers);
    }

    public function delete($path, array $headers = []): array
    {
        return $this->request('delete', $path, $headers);
    }

    public function request($method, $path, array $data = [], array $headers = []): array
    {
        $method = strtoupper($method);

        $key = $method === 'GET' ? 'query' : 'json';

        $request = $this->client->request($method, $path, [
            $key => $data,
            'headers' => $headers,
        ]);

        $response = json_decode($request->getBody());

        return $response;
    }

    public function apiVersion(): string
    {
        return $this->api_version;
    }

    public function redirectUri(): string
    {
        return $this->redirect_uri;
    }
}
