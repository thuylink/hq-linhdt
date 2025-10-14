<?php

namespace App\Repositories\Repository;

use App\Models\Author;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\AuthorRepositoryInterface;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    public function __construct(Author $author)
    {
        parent::__construct($author);
    }
}
