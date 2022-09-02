<?php

namespace Phinch\Finch;

use GuzzleHttp\Exception\GuzzleException;

class Finch
{
    /**
     * @var FinchClient
     */
    protected FinchClient $client;

    /**
     * Finch constructor.
     *
     * @param FinchClient $client
     */
    public function __construct(FinchClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param $name
     * @param mixed $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $product_name = ucwords($name);

        $class = __CLASS__.'\\Products\\'.$product_name;

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

        return $this->__call($name);
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
     * @return array
     * @throws GuzzleException
     */
    public function providers(): array
    {
        return $this->management()->providers();
    }
}
