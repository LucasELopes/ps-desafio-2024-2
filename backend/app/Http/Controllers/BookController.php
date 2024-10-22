<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest\StoreBookRequest;
use App\Http\Requests\BookRequest\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    public function index()
    {
        $book = $this->book->all();
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

        $book = $this->book->create([
            'nome' => $data['nome'],
            'autor' => $data['autor'],
            'data_de_lancamento' => $data['data_de_lancamento'],
            'imagem' => $data['imagem'],
            'quantidade' => $data['quantidade'],
        ]);

        $book->categories()->sync($data['category_id']);

        return response()->json(BookResource::make($book), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $book = $this->book->findOrFail($id);
        return response()->json(BookResource::make($book), Response::HTTP_FOUND);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {   
        $data = $request->validated();
        
        $book = $this->book->findOrFail($id);

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            try { //Caso a imagem exista no storage exclua o respectivo arquivo.

                $imagemName = explode('books/', $book->imagem);

                Storage::disk('public')->delete('books/'.$imagemName[1]);

            } catch (\Throwable $th) {
            }finally{
                try { // Atualiza o arquivo deletado 

                    $imagemName = explode('/', $book->imagem);
                    
                    // $imagemName[1] === Nome da respectiva pasta do arquivo que será atualizado
                    $data['imagem'] = $request->file('imagem')->store(
                        'books/'. $imagemName[1],
                        'public'
                    );
                    
                } catch (\Throwable $th) {
                    // Caso o campo da imagem no banco, mesmo sendo um campo obrigatório ao criar o livro, esteja vazio
                    // salva a mesma no storage.                    

                    $data['imagem'] = $request->file('imagem')->store(
                        'books/book_'. 
                            md5($request->nome . $request->autor . strtotime('now')), 
                        'public'
                    );
                }
            }
        }
    
        $book->update($data);

        if(key_exists('category_id', $data)) {
            $book->categories()->sync($data['category_id']);
        }

        $book->refresh();

        return response()->json(BookResource::make($book), Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $book = $this->book->findOrFail($id);
        $book->delete();
        $book->categories()->detach();

        return response()->json('Deleted', Response::HTTP_OK);

    }

}
