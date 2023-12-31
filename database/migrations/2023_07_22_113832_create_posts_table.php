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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id');
            $table->foreignId('category_id');
            $table->string( 'title' );
            $table->string('thumbnail')->nullable();
            $table->string( 'slug' )->unique();
            $table->text( 'excerpt');
            $table->text( 'body' );
            $table->timestamp('published_at' )->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on( 'users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
