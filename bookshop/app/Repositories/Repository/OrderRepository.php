<?php

namespace App\Repositories\Repository;

use App\Models\Category;
use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }
}
