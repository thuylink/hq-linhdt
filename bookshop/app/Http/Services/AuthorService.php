<?php

namespace App\Http\Services;

use App\Http\Resources\AuthorResource;
use App\Http\Resources\CategoryResource;
use App\Repositories\Interface\AuthorRepositoryInterface;
use App\Repositories\Interface\AuthRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class AuthorService
{
    public function __construct(
        protected AuthorRepositoryInterface $authorRepositoryInterface
    ) {}
    public function index(int $perPage)
    {
        $authors = $this->authorRepositoryInterface->paginate($perPage);
        return $authors;
    }

    public function detail(int $id) {
        $author = $this->authorRepositoryInterface->find($id);
        return $author;
    }

    public function store(array $data)
    {
        $author = $this->authorRepositoryInterface->create(
            [
                'name' => $data['name'],
                'bio' => $data['bio'] ?? null,
                'birthday' => $data['birthday'] ?? null,
                'deathdate' => $data['deathdate'] ?? null,
                'gender' => $data['gender'] ?? null,
            ]
        );
        return $author;
    }

    public function update(int $id, array $data)
    {
        $dataUpdate = [
                'name' => $data['name'],
                'bio' => $data['bio'] ?? null,
                'birthday' => $data['birthday'] ?? null,
                'deathdate' => $data['deathdate'] ?? null,
                'gender' => $data['gender'] ?? null,
        ];
        $author = $this->authorRepositoryInterface->update($id, $dataUpdate);
        return $author;
    }

    public function destroy(int $id)
    {
        $author = $this->authorRepositoryInterface->delete($id);
        return $author;
    }
}
