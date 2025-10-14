<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublisherRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\PublisherResource;
use App\Http\Services\PublisherService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PublisherController extends Controller
{
    public function __construct(
        protected PublisherService $publisherService
    ) {}
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $publishers = $this->publisherService->index($perPage);

        return new PaginationResource($publishers);
    }

    public function store(PublisherRequest $publisherRequest)
    {
        $validatedData = $publisherRequest->validated();
        $publisher = $this->publisherService->store($validatedData);

        return response()->json(['data' => $publisher], Response::HTTP_CREATED);
    }

    public function update(PublisherRequest $publisherRequest, int $id)
    {
        $publisher = $this->publisherService->update($id, $publisherRequest->validated());

        return response()->json([
            'message' => 'Updated publisher',
            'data' => $publisher
        ], Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $publisher = $this->publisherService->destroy($id);

        return response()->json([
            'message' => 'Deleted publisher',
            'data' => $publisher
        ], Response::HTTP_OK);
    }
}
