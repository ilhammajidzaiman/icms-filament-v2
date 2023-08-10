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
        Schema::create('slideshows', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(1)->comment('status');
            $table->string('title')->nullable()->unique()->comment('judul');
            $table->string('slug')->nullable()->unique()->comment('slug');
            $table->string('subtitle')->nullable()->comment('subtitle');
            $table->string('file')->comment('gambar');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slideshows');
    }
};
