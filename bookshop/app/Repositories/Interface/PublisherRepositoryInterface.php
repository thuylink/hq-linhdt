<?php

namespace App\Repositories\Interface;

use App\Repositories\BaseRepositoryInterface;

interface PublisherRepositoryInterface extends BaseRepositoryInterface
{
    public function paginate(int $perPage);
}
