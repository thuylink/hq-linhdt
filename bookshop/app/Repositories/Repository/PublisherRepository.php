<?php

namespace App\Repositories\Repository;

use App\Http\Resources\PublisherResource;
use App\Models\Publisher;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\PublisherRepositoryInterface;

class PublisherRepository extends BaseRepository implements PublisherRepositoryInterface
{
    public function __construct(Publisher $publisher)
    {
        parent::__construct($publisher);
    }
}
