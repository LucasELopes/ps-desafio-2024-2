<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest\StoreBookRequest;
use App\Http\Requests\BookRequest\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookController extends Controller
{

    protected $book;

    public function __construct(Book $book) {
        $this->book = $book;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
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

            $nomeImagem = $request->imagem->hashName();
            
            $path = $request->imagem->storeAs(
                'public/books/book_'. 
                $request->nome."_" 
                .md5($request->autor . $request->data_de_lancamento . strtotime('now'))
                ."/".$nomeImagem
            );

            $data['imagem'] = $path;

        }

        $book = $this->book->create($data);

        return response()->json(BookResource::make($book), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {

            $book = $this->book->findOrFail($id);
            return response()->json(BookResource::make($book), Response::HTTP_OK);

        }catch(\Throwable) {

            return response()->json([], Response::HTTP_UNPROCESSABLE_ENTITY);

        }   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $data = $request->validated();
        $book = $this->book->with('categorie')->findOrFail($id);

        if($request->hasFile('imagem')) {
            try {
                $imagem_name = explode('books/', $book['imagem']);
                Storage::disk('public')->delete('books/');
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
