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
        $categories = $this->category->orderBy("nome", "asc")->get();

        return response()->json(CategoryResource::collection($categories), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();

        $catogory = $this->category->create($data);

        return response()->json(CategoryResource::make($catogory), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {

        $category = $this->category->findOrFail($id);
        return response()->json($category, Response::HTTP_OK);

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
        $category->books()->detach();
        return response()->json(CategoryResource::make($category), Response::HTTP_OK);
    }

}
