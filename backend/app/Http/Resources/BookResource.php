<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'autor' => $this->autor,
            'data_de_lancamento' => $this->data_de_lancamento,
            'imagem' => $this->imagem,
            'categoria' => [
                'id' => $this->category->id,
                'nome' => $this->category->nome,
            ],
            'quantidade' => $this->quantidade
        ];
    }
}
