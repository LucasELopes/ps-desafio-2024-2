<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest\StoreCategoryRequest;
use App\Http\Requests\CategoryRequest\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{

    protected $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categorys = $this->category->orderBy("nome", "asc")->get();

        return response()->json(CategoryResource::collection($categorys), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();

        $catogorie = $this->category->create($data);

        return response()->json(CategoryResource::make($catogorie), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {

        try {
            $category = $this->category->findOrFail($id);
            return response()->json($category, Response::HTTP_OK);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_NOT_FOUND);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $category = $this->category->findOrFail($id);

        $category->update($data);

        return response()->json(CategoryResource::make($category), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();

        return response()->json(CategoryResource::make($category), Response::HTTP_OK);
    }
}
