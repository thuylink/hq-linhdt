<?php

namespace App\Repositories\Repository;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
    public function findByParent(int $idParent)
    {
        $this->model->where('parent_id', $idParent)->get();
    }
    public function destroyParent(int $idParent)
    {
        $this->model->where('parent_id', $idParent)->orWhere('id', $idParent)->delete();
    }
}
