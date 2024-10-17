<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('nome', 50);
            $table->string('autor', 50);
            $table->date('data_de_lancamento');
            $table->string('imagem');
            $table->foreignUuid('categoria_id')->constrained('categories');
            $table->unsignedInteger('quantidade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
