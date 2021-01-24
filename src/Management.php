<?php

namespace Phinch;

class Management
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function token($code): array
    {
        return $this->client->post('auth/token', [
            'code' => $code,
            'redirect_uri' => $this->client->redirectUri(),
        ]);
    }

    public function disconnect($access_token): array
    {
        return $this->client->post('disconnect', [], [
            'headers' => [
                'Authorization' => "Bearer {$access_token}",
                'Finch-API-Version' => $this->client->apiVersion(),
            ],
        ]);
    }

    public function introspect($access_token): array
    {
        return $this->client->get('introspect', [], [
            'headers' => [
                'Authorization' => "Bearer {$access_token}",
                'Finch-API-Version' => $this->client->apiVersion(),
            ],
        ]);
    }

    public function providers(): array
    {
        return $this->client->get('providers');
    }
}
