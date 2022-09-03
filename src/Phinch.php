<?php

namespace Phinch;

use GuzzleHttp\Exception\GuzzleException;

class Phinch
{
    /**
     * Finch constructor.
     *
     * @param PhinchClient $client
     */
    public function __construct(protected PhinchClient $client)
    {
    }

    /**
     * @param $name
     * @param mixed $arguments
     *
     * @return mixed
     */
    public function __call($name, mixed $arguments)
    {
        if ($name === 'authorize') {
            $this->client->authorize($arguments[0]);

            return $this;
        }

        $product_name = ucwords($name);

        $class = __NAMESPACE__ . '\\Products\\' . $product_name;

        if (class_exists($class)) {
            return new $class($this->client);
        }

        throw new \InvalidArgumentException("The requested product '{$name}' does not exist.");
    }

    /**
     * @param $name
     *
     * @return false|mixed
     */
    public function __get($name)
    {
        if (method_exists($this, $name)) {
            return call_user_func($this->{$name}, func_get_args());
        }

        return $this->__call($name, func_get_args());
    }

    /**
     * @return Management
     */
    public function management(): Management
    {
        return new Management($this->client);
    }

    /**
     * @param $code
     *
     * @return array
     * @throws GuzzleException
     */
    public function token($code): array
    {
        return $this->management()->token($code);
    }

    /**
     * Read account information associated with an access_token
     * https://developer.tryfinch.com/docs/reference/eee6e798b0f93-introspect
     *
     * @param $access_token
     *
     * @return array
     * @throws GuzzleException
     */
    public function introspect($access_token): array
    {
        return $this->management()->introspect($access_token);
    }

    /**
     * Disconnect an employer from your application and invalidate all access_tokens associated with the employer.
     * We require applications to implement the Disconnect endpoint for billing and security purposes.
     * https://developer.tryfinch.com/docs/reference/c65ecbd512332-disconnect
     *
     * @param $access_token
     *
     * @return array
     * @throws GuzzleException
     */
    public function disconnect($access_token): array
    {
        return $this->management()->disconnect($access_token);
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
        return $this->management()->providers();
    }
}
