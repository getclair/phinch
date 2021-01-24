<?php

namespace Phinch;

class Finch
{
    protected FinchClient $client;

    public function __construct(FinchClient $client)
    {
        $this->client = $client;
    }

    public function __call($name)
    {
        $product_name = ucwords($name);

        $class = __CLASS__.'\\Products\\'.$product_name;

        if (class_exists($class)) {
            return new $class($this->client);
        }

        throw new \InvalidArgumentException("The requested product '{$name}' does not exist.");
    }

    public function __get($name)
    {
        if (method_exists($this, $name)) {
            return call_user_func($this->{$name}, func_get_args());
        }

        return $this->__call($name);
    }

    public function management(): Management
    {
        return new Management($this->client);
    }

    public function token($code): array
    {
        return $this->management()->token($code);
    }

    public function introspect($access_token): array
    {
        return $this->management()->introspect($access_token);
    }

    public function disconnect($access_token): array
    {
        return $this->management()->disconnect($access_token);
    }

    public function providers(): array
    {
        return $this->management()->providers();
    }
}
