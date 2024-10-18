<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest\StoreBookRequest;
use App\Http\Requests\BookRequest\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Storage;

class BookController extends Controller
{

    protected $book;

    public function __construct(Book $book) {
        $this->book = $book;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $book = $this->book->with('categorie')->get();
        return response()->json(BookResource::collection($book), Response::HTTP_OK);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {

            $path = $request->file('imagem')->store(
                'books/book_'. 
                    md5($request->nome . $request->autor . strtotime('now')), 
                'public'
            );

            $data['imagem'] = $path;
        }

        $book = $this->book->create($data);

        return response()->json(BookResource::make($book), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        try {
            $book = $this->book->findOrFail($id);
            return response()->json(BookResource::make($book), Response::HTTP_FOUND);

        }catch(\Throwable) {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $data = $request->validated();
        return $request->validated();

        try {
            $book = $this->book->with('categorie')->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([], Response::HTTP_NOT_FOUND);
        }

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            try {

                $imagemName = explode('books/', $book->imagem);
                Storage::disk('public')->delete('books/'.$imagemName[1]);

                return $imagemName;

            } catch (\Throwable $th) {
            }finally{
                $data['imagem'] = $request->file('imagem')->store(
                    'books/book_'. 
                        md5($request->nome . $request->autor . strtotime('now')), 
                    'public'
                );
            }
        }

        // return dd($data);

        $book->update($data);

        return response()->json(BookResource::make($book), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
