<?php

namespace Phinch;

class Paginated
{
    /**
     * @var array
     */
    protected array $data;

    /**
     * Paginated constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Pagination metadata.
     *
     * @return array
     */
    public function meta(): array
    {
        return $this->data['paging'];
    }

    /**
     * Pagination results.
     *
     * @return array
     */
    public function results(): array
    {
        $data = $this->data;

        unset($data['paging']);

        $data = array_values($data);

        return array_shift($data);
    }
}
