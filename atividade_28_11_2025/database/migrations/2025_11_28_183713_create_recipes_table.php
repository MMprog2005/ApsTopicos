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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('ingredients');      // lista / JSON ou texto
            $table->text('instructions');     // modo de preparo
            $table->string('category')->nullable(); // ex: "sobremesa"
            $table->integer('prep_time')->nullable(); // minutos
            $table->string('image_path')->nullable(); // caminho da imagem
            $table->unsignedBigInteger('user_id')->nullable(); // autor (opcional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
