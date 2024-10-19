<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieRequest\StoreCategorieRequest;
use App\Http\Requests\CategorieRequest\UpdateCategorieRequest;
use App\Http\Resources\CategorieResource;
use App\Models\Categorie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategorieController extends Controller
{

    protected $categorie;

    public function __construct(Categorie $categorie) {
        $this->categorie = $categorie;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categories = $this->categorie->orderBy("nome", "asc")->get();

        return response()->json(CategorieResource::collection($categories), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request): JsonResponse
    {
        $data = $request->validated();

        $catogorie = $this->categorie->create($data);

        return response()->json(CategorieResource::make($catogorie), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {

        try {
            $categorie = $this->categorie->findOrFail($id);
            return response()->json($categorie, Response::HTTP_OK);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_NOT_FOUND);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $categorie = $this->categorie->findOrFail($id);

        $categorie->update($data);

        return response()->json(CategorieResource::make($categorie), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categorie = $this->categorie->findOrFail($id);
        $categorie->delete();

        return response()->json(CategorieResource::make($categorie), Response::HTTP_OK);
    }
}
