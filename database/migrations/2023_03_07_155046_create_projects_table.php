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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 80)->unique();
            $table->string('author', 30);
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('slug', 80)->unique();
            $table->string('image')->nullable();
            $table->string('url_project', 1000)->nullable();
            $table->string('url_generic', 1000)->nullable();
            $table->timestamps();
        });
    }

    // TODO modificare la parola slag


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
