<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\PaginationResource;
use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {}
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $categories = $this->categoryService->index($perPage);
        return new PaginationResource($categories);
    }

    public function detail(int $id)
    {
        $category = $this->categoryService->detail($id);
        return response()->json(
            [
                'data' => $category
            ],
            Response::HTTP_OK
        );
    }
    public function store(StoreCategoryRequest $storeCategoryRequest)
    {
        $validatedData = $storeCategoryRequest->validated();
        $category = $this->categoryService->store($validatedData);
        return response()->json(['data' => $category], Response::HTTP_CREATED);
    }

    public function update(StoreCategoryRequest $storeCategoryRequest, int $id)
    {
        $category = $this->categoryService->update($id, $storeCategoryRequest->validated());
        return response()->json([
            'message' => 'Updated category',
            'data' => $category
        ], Response::HTTP_OK);
    }

    public function destroy(int $id)
    {
        $category = $this->categoryService->destroy($id);

        return response()->json([
            'message' => 'Deleted category',
            'data' => $category
        ], Response::HTTP_OK);
    }

    public function searchKeyword($keyword = null)
    {
        $categories = DB::table('categories')
            // ->where('name', "Books2")
            ->whereNot(function (Builder $q) {
                $q->where('name', 'Books2')
                    ->where('flag', 1);
            })
            ->get()
            // ->ddRawSql()
            ;
        dd($categories);
    }
}
