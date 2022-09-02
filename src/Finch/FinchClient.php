<?php

namespace Phinch\Finch;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class FinchClient
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
     * FinchClient constructor.
     *
     * @param string $client_id
     * @param string $client_secret
     * @param string $api_version
     * @param string $redirect_uri
     */
    public function __construct(protected string $client_id, protected string $client_secret, protected string $api_version, protected string $redirect_uri)
    {
        $credentials = base64_encode("{$client_id}:{$client_secret}");

        $this->client = new Client([
            'base_uri' => self::$base_uri,
            'headers' => [
                'Authorization' => "Basic {$credentials}",
                'Finch-API-Version' => $api_version,
            ],
        ]);
    }

    /**
     * Make GET request.
     *
     * @param $path
     * @param array $query
     * @param array $headers
     *
     * @return array
     * @throws GuzzleException
     */
    public function get($path, array $query = [], array $headers = []): array
    {
        return $this->request('get', $path, $query, $headers);
    }

    /**
     * Make POST request.
     *
     * @param $path
     * @param array $params
     * @param array $headers
     *
     * @return array
     * @throws GuzzleException
     */
    public function post($path, array $params = [], array $headers = []): array
    {
        return $this->request('post', $path, $params, $headers);
    }

    /**
     * Make PUT request.
     *
     * @param $path
     * @param array $params
     * @param array $headers
     *
     * @return array
     * @throws GuzzleException
     */
    public function put($path, array $params = [], array $headers = []): array
    {
        return $this->request('put', $path, $params, $headers);
    }

    /**
     * Make DELETE request.
     *
     * @param $path
     * @param array $headers
     *
     * @return array
     * @throws GuzzleException
     */
    public function delete($path, array $headers = []): array
    {
        return $this->request('delete', $path, $headers);
    }

    /**
     * @param $method
     * @param $path
     * @param array $data
     * @param array $headers
     * @return array
     * @throws GuzzleException
     */
    public function request($method, $path, array $data = [], array $headers = []): array
    {
        $method = strtoupper($method);

        $key = $method === 'GET' ? 'query' : 'json';

        $request = $this->client->request($method, $path, [
            $key => $data,
            'headers' => $headers,
        ]);

        return json_decode($request->getBody());
    }

    /**
     * @return string
     */
    public function apiVersion(): string
    {
        return $this->api_version;
    }

    /**
     * @return string
     */
    public function redirectUri(): string
    {
        return $this->redirect_uri;
    }
}
