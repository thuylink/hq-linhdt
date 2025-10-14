<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Services\AuthorService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    public function __construct(
        protected AuthorService $authorService
    ) {}

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $authors  = $this->authorService->index($perPage);

        return new PaginationResource($authors);
    }

    public function detail(int $id) {
        $author = $this->authorService->detail($id);
        return response()->json([
            'data' => $author
        ],
        Response::HTTP_OK);
    }
    public function store(AuthorRequest $authorRequest)
    {
        $validatedData = $authorRequest->validated();
        $author = $this->authorService->store($validatedData);
        return response()->json(['data' => $author], Response::HTTP_CREATED);
    }

    public function update(AuthorRequest $authorRequest, int $id)
    {
        $author = $this->authorService->update($id, $authorRequest->validated());
        return response()->json([
            'message' => 'Updated Author',
            'data' => $author
        ], Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $author = $this->authorService->destroy($id);
        return response()->json([
            'message' => 'Deleted author',
            'data' => $author
        ], Response::HTTP_OK);
    }
}
