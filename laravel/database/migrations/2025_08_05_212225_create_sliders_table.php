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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            // Cấu hình Swiper
            $table->integer('slides_per_view')->default(1);         // số lượng hiển thị
            $table->boolean('loop')->default(true);                 // lặp vòng
            $table->boolean('autoplay')->default(true);             // bật autoplay
            $table->integer('autoplay_delay')->default(3000);       // delay autoplay (ms)
            $table->boolean('pagination')->default(true);           // bật phân trang
            $table->boolean('navigation')->default(true);           // nút điều hướng
            $table->string('effect')->default('slide');             // slide, fade,...
            $table->integer('space_between')->default(10);          // khoảng cách giữa các slide

            $table->json('items');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
