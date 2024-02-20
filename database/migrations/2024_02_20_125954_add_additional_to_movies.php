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
        Schema::table('movies', function (Blueprint $table) {
            //
            $table->text('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('country')->nullable();
            $table->longText('actor')->nullable();
            $table->string('actor_image')->nullable();
            $table->string('producer')->nullable();
            $table->string('producer_image')->nullable();
            $table->string('movie_logo')->nullable();
            $table->string('landscape_image')->nullable();
            $table->string('portrait_image')->nullable();
            $table->string('duration')->nullable();
            $table->string('trailer')->nullable();
            $table->string('slug')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            //
        });
    }
};
