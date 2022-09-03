<?php

namespace Phinch\Connect;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Connect
{
    /**
     * @var array|string[]
     */
    protected array $products = [
        'company',
        'directory'
    ];

    /**
     * @var string|null
     */
    protected ?string $state = null;

    /**
     * @var string|null
     */
    protected ?string $provider = null;

    /**
     * @var bool
     */
    protected bool $sandbox = false;

    /**
     * @param string $client_id
     * @param string $client_secret
     * @param string $redirect_uri
     */
    public function __construct(protected string $client_id, protected string $client_secret, protected string $redirect_uri)
    {
    }

    /**
     * Build the URL to open Finch Connect
     * https://developer.tryfinch.com/docs/reference/61cff54e1d9b3-your-application-redirects-to-finch-connect#open-finch-connect
     *
     * @return string
     */
    public function redirectUrl(): string
    {
        $query = http_build_query(array_filter([
            'client_id' => $this->client_id,
            'redirect_uri' => $this->redirect_uri,
            'products' => implode(' ', $this->products),
            'sandbox' => $this->sandbox,
            'state' => $this->state,
            'payroll_provider' => $this->provider,
        ]));

        return "https://connect.tryfinch.com/authorize?".$query;
    }

    /**
     * Exchange the code for the access token.
     * https://developer.tryfinch.com/docs/reference/61cff54e1d9b3-your-application-redirects-to-finch-connect#obtain-consent
     *
     * @param string $code
     * @return string
     * @throws GuzzleException
     */
    public function exchange(string $code): string
    {
        $client = new Client([
            'json' => [
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'code' => $code,
                'redirect_uri' => $this->redirect_uri,
            ],
        ]);

        $response = $client->post("https://api.tryfinch.com/auth/token");

        $data = json_decode($response->getBody());

        return $data->access_token;
    }

    /**
     * @param array $products
     * @return $this
     */
    public function products(array $products): static
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function state(mixed $value): static
    {
        $this->state = $value;

        return $this;
    }

    /**
     * @param string $provider
     * @return $this
     */
    public function payrollProvider(string $provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return $this
     */
    public function inSandbox(): static
    {
        $this->sandbox = true;

        return $this;
    }
}