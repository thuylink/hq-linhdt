<?php

namespace App\Http\Services;

use App\Http\Resources\BookResource;
use App\Repositories\Interface\BookRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BookService
{
    public function __construct(
        protected BookRepositoryInterface $bookRepositoryInterface
    ) {}
    public function index(int $perPage)
    {
        $books = $this->bookRepositoryInterface->paginate($perPage);
        return $books;
    }

    public function detail(int $id) {
        $book = $this->bookRepositoryInterface->find($id);
        return $book;
    }

    public function store(array $data)
    {
        $adminId = Auth::id();

        $book = $this->bookRepositoryInterface->create(
            [
                'category_id' => $data['category_id'],
                'name' => $data['name'],
                'price' => $data['price'],
                'quantity' => $data['quantity']
            ]
        );
        return $book;
    }

    public function update(int $id, array $data)
    {
        $dataUpdate = [
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'price' => $data['price'],
            'quantity' => $data['quantity']

        ];
        $book= $this->bookRepositoryInterface->update($id, $dataUpdate);
        return $book;
    }

    public function destroy(int $id)
    {
        $book = $this->bookRepositoryInterface->delete($id);
        return $book;
    }
}
