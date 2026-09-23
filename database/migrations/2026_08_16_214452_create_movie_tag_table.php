<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movie_tag', function (Blueprint $table) {
            $table->id();

            $table->uuid('movie_id');
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('cascade');

            $table->foreignId('tag_id')
                ->constrained('tags')
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['movie_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movie_tag');
    }
};