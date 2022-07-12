<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description', 255)->nullable()->default(null);
            $table->string('item_type')->default('image')->comment('image / video');
            $table->string('image_lg', 255)->nullable()->default(null);
            $table->string('image_md', 255)->nullable()->default(null);
            $table->string('image_sm', 255)->nullable()->default(null);
            $table->string('youtube_url', 255)->nullable()->default(null);
            $table->boolean('status')->default(true);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_items');
    }
};
