<?php

namespace Phinch\Finch\Products;

use Phinch\Finch\Paginated;
use Phinch\Finch\Products\BaseProduct;

class Directory extends BaseProduct
{
    protected const PREFIX = 'employer/directory';

    public function viewAll(): Paginated
    {
        return new Paginated($this->client->get(self::PREFIX));
    }
}
