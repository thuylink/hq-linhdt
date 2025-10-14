<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Services\BookService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function __construct(
        protected BookService $bookService
    ) {}
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $books = $this->bookService->index($perPage);
        return new PaginationResource($books);
    }

    public function detail(int $id) {
        $category = $this->bookService->detail($id);
        return response()->json([
            'data' => $category
        ],
        Response::HTTP_OK);
    }

    public function store(BookRequest $bookRequest)
    {
        $validatedData = $bookRequest->validated();
        $book = $this->bookService->store($validatedData);
        return response()->json(['data' => $book], Response::HTTP_CREATED);
    }

    public function update(BookRequest $bookRequest, int $id)
    {
        $book = $this->bookService->update($id, $bookRequest->validated());
        return response()->json([
            'message' => 'Updated book',
            'data' => $book
        ], Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $book = $this->bookService->destroy($id);

        return response()->json([
            'message' => 'Deleted book',
            'data' => $book
        ], Response::HTTP_OK);
    }
}
