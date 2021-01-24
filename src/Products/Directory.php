<?php

namespace Phinch\Products;

use Phinch\Paginated;

class Directory extends BaseProduct
{
    protected const PREFIX = 'employer/directory';

    public function viewAll(): Paginated
    {
        return new Paginated($this->client->get(self::PREFIX));
    }
}
