<?php

namespace Phinch;

class Paginated
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function paging(): array
    {
        return $this->data['paging'];
    }

    public function results(): array
    {
        $data = $this->data;

        unset($data['paging']);

        $data = array_values($data);

        return array_shift($data);
    }
}
