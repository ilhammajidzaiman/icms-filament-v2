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
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete()->comment('id table users');
            // $table->foreignId('blog_status_id')->constrained('blog_statuses')->cascadeOnUpdate()->restrictOnDelete()->comment('id table blog_statuses');
            $table->boolean('is_active')->comment('status');
            $table->string('title')->unique()->comment('judul');
            $table->string('slug')->unique()->comment('slug dari judul');
            $table->binary('content')->comment('bagian isi artikel');
            $table->string('truncated')->comment('review artikel');
            // $table->string('path')->nullable()->comment('folder file gambar artikel');
            $table->string('file')->nullable()->comment('file gambar artikel');
            $table->bigInteger('counter')->nullable()->comment('jumlah pengunjung');
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
