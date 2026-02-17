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

            // Relasi ke users
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('title', 255);
            $table->text('description')->nullable();

            // Nama file gambar
            $table->string('image', 255);

            // Metadata
            $table->string('tags')->nullable();
            $table->string('category', 100)->nullable();

            // Pengaturan
            $table->boolean('is_private')->default(false);
            $table->boolean('allow_download')->default(true);
            $table->boolean('allow_comment')->default(true);

            // Index untuk performa filter
            $table->index('category');
            $table->index('is_private');

            $table->timestamps();
            $table->softDeletes(); // untuk soft delete
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
