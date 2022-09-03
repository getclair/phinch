<?php

namespace Phinch\Products;

use GuzzleHttp\Exception\GuzzleException;
use Phinch\Paginated;

class Directory extends BaseProduct
{
    protected const PREFIX = 'employer/directory';

    /**
     * Read company directory and organization structure
     * https://developer.tryfinch.com/docs/reference/12419c085fc0e-directory
     *
     * @return Paginated
     * @throws GuzzleException
     */
    public function all(): Paginated
    {
        return new Paginated($this->client->get(self::PREFIX), 'individuals');
    }
}
