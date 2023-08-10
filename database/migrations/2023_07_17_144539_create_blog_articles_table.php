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
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete()->comment('id table users');
            $table->foreignId('blog_category_id')->constrained('blog_categories')->cascadeOnUpdate()->restrictOnDelete()->comment('id table blog_categories');
            $table->boolean('is_active')->default(1)->comment('status');
            $table->string('title')->unique()->comment('judul');
            $table->string('slug')->unique()->comment('slug');
            $table->binary('content')->comment('isi ');
            $table->string('tags')->comment('tanda');
            $table->string('file')->comment('gambar');
            $table->bigInteger('visitor')->nullable()->comment('jumlah pengunjung');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_articles');
    }
};
