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
     * @param int $offset
     * @param int $limit
     * @return Paginated
     * @throws GuzzleException
     */
    public function all(int $offset = 0, int $limit = 20): Paginated
    {
        return $this->paginate($this->client->get(self::PREFIX, [
            'limit' => $limit,
            'offset' => $offset
        ]), 'individuals');
    }
}
