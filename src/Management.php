<?php

namespace Phinch;

use GuzzleHttp\Exception\GuzzleException;

class Management
{
    /**
     * @param PhinchClient $client
     */
    public function __construct(protected PhinchClient $client)
    {
    }

    /**
     * @param $code
     * @return array
     * @throws GuzzleException
     */
    public function token($code): array
    {
        return $this->client->post('auth/token', [
            'code' => $code,
            'redirect_uri' => $this->client->redirectUri(),
        ]);
    }

    /**
     * @param $access_token
     * @return array
     * @throws GuzzleException
     */
    public function disconnect($access_token): array
    {
        return $this->client->post('disconnect', [], [
            'headers' => [
                'Authorization' => "Bearer {$access_token}",
                'Finch-API-Version' => $this->client->apiVersion(),
            ],
        ]);
    }

    /**
     * @param $access_token
     * @return array
     * @throws GuzzleException
     */
    public function introspect($access_token): array
    {
        return $this->client->get('introspect', [], [
            'headers' => [
                'Authorization' => "Bearer {$access_token}",
                'Finch-API-Version' => $this->client->apiVersion(),
            ],
        ]);
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function providers(): array
    {
        return $this->client->get('providers');
    }
}
