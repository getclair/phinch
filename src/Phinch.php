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
     * @return array
     * @throws GuzzleException
     */
    public function introspect(): array
    {
        return $this->management()->introspect();
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function disconnect(): array
    {
        return $this->management()->disconnect();
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function providers(): array
    {
        return $this->management()->providers();
    }
}