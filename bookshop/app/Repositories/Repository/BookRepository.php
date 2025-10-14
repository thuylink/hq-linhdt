<?php

namespace App\Repositories\Repository;

use App\Models\Book;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\BookRepositoryInterface;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function __construct(Book $book)
    {
        parent::__construct($book);
    }
}
