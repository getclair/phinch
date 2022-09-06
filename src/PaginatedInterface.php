<?php

namespace Phinch;

interface PaginatedInterface
{
    /**
     * @return array
     */
    public function results(): array;

    /**
     * @return array
     */
    public function meta(): array;
}