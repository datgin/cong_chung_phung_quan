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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('hotline')->nullable();
            $table->string('address')->nullable();
            $table->string('url_zalo')->nullable();
            $table->string('url_messenger')->nullable();
            $table->string('url_facebook')->nullable();
            $table->string('url_twitter')->nullable();
            $table->string('url_youtobe')->nullable();
            $table->text('map')->nullable();
            $table->string('banner')->nullable();
            $table->string('alt_banner')->nullable();
            $table->string('link_banner')->nullable();

            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->string('copyright')->nullable();

            $table->text('script_head')->nullable();
            $table->text('script_body')->nullable();
            $table->text('script_footer')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
