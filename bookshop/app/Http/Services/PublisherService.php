<?php

namespace App\Http\Services;

use App\Http\Resources\PublisherResource;
use App\Repositories\Interface\PublisherRepositoryInterface;

class PublisherService
{
    public function __construct(
        protected PublisherRepositoryInterface $publisherRepositoryInterface
    ) {}
    public function index(int $perPage)
    {
        $publishers = $this->publisherRepositoryInterface->paginate($perPage);
        return $publishers;
    }

    public function detail(int $id) {
        $publisher = $this->publisherRepositoryInterface->find($id);
        return $publisher;
    }

    public function store(array $data)
    {
        $publishers = $this->publisherRepositoryInterface->create(
            [
                'name' => $data['name'],
                'address' => $data['address'] ?? null,
                'phone' => $data['phone'] ?? null,
                'email' => $data['email'] ?? null,
                'website' => $data['website'] ?? null,
            ]
        );
        return $publishers;
    }

    public function update(int $id, array $data)
    {
        $dataUpdate = [
            'name' => $data['name'],
            'address' => $data['address'] ?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'website' => $data['website'] ?? null,
        ];
        $publishers = $this->publisherRepositoryInterface->update($id, $dataUpdate);
        return $publishers;
    }

    public function destroy(int $id)
    {
        $publishers = $this->publisherRepositoryInterface->find($id);
        $publishers->delete();
        return $publishers;
    }
}
