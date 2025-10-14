<?php

namespace App\Http\Services;

use App\Http\Resources\CategoryResource;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryService
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepositoryInterface
    ) {}
    public function index(int $perPage)
    {
        $categories = $this->categoryRepositoryInterface->paginate($perPage);
        return $categories;
    }

    public function detail(int $id) {
        $category = $this->categoryRepositoryInterface->find($id);
        return $category;
    }

    public function store(array $data)
    {
        $category = $this->categoryRepositoryInterface->create(
            [
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'flag' => $data['flag'] ?? null,
                'parent_id' => $data['parent_id'] ?? null,
                'banner' => $data['banner'] ?? null,
            ]
        );

        return $category;
    }

    public function update(int $id, array $data)
    {
        $dataUpdate = [
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'flag' => $data['flag'] ?? null,
            'parent_id' => $data['parent_id'] ?? null,
            'banner' => $data['banner'] ?? null,
        ];
        $category = $this->categoryRepositoryInterface->update($id, $dataUpdate);
        return $category;
    }

    public function destroy(int $id)
    {
        $category = $this->categoryRepositoryInterface->delete($id);
        return $category;
    }
}
