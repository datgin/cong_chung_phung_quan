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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');

            $table->string('thumbnail')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            // Trạng thái
            $table->boolean('published')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
