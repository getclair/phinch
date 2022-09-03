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
     * Disconnect an employer from your application and invalidate all access_tokens associated with the employer.
     * We require applications to implement the Disconnect endpoint for billing and security purposes.
     * https://developer.tryfinch.com/docs/reference/c65ecbd512332-disconnect
     *
     * @return array
     * @throws GuzzleException
     */
    public function disconnect(): array
    {
        return $this->client->post('disconnect');
    }

    /**
     * Read account information associated with an access_token
     * https://developer.tryfinch.com/docs/reference/eee6e798b0f93-introspect
     *
     * @return array
     * @throws GuzzleException
     */
    public function introspect(): array
    {
        return $this->client->get('introspect');
    }

    /**
     * Return details on all available payroll and HR systems.
     * https://developer.tryfinch.com/docs/reference/327c384190aeb-providers
     *
     * @return array
     * @throws GuzzleException
     */
    public function providers(): array
    {
        return $this->client->get('providers');
    }
}
