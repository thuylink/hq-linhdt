<?php

namespace App\Repositories\Interface;

use App\Repositories\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function findByParent(int $idParent);
    public function destroyParent(int $idParent);
}
