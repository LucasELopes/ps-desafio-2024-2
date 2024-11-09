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

        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $path = $request->file('image')->store(
                'books/book_'. 
                    md5($request->nome . $request->autor . strtotime('now')), 
                'public'
            );

            $data['image'] = url('storage/', $path);
        }

        $book = $this->book->create([
            'title' => $data['title'],
            'author' => $data['author'],
            'release_date' => $data['release_date'],
            'image' => $data['image'],
            'amount' => $data['amount'],
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

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            try { //Caso a imagem exista no storage exclua o respectivo arquivo.

                $imageName = explode('books/', $book->image);

                Storage::disk('public')->delete('books/'.$imageName[1]);

            } catch (\Throwable $th) {
            }finally{
                try { // Atualiza o arquivo deletado 

                    $imageName = explode('/', $book->image);
                    
                    // $imageName[1] === Nome da respectiva pasta do arquivo que será atualizado
                    $data['image'] = url('storage/', $request->file('image')->store(
                        'books/'. $imageName[1],
                        'public'
                    ));
                    
                } catch (\Throwable $th) {
                    // Caso o campo da imagem no banco, mesmo sendo um campo obrigatório ao criar o livro, esteja vazio
                    // salva a mesma no storage.                    

                    $data['image'] = url('storage', $request->file('image')->store(
                        'books/book_'. 
                            md5($request->name . $request->author . strtotime('now')), 
                        'public'
                    ));
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
