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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 255)->nullable()->default(null);
            $table->string('slug');
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->string('image_lg', 255)->nullable()->default(null)->comment('cover image');
            $table->string('image_md', 255)->nullable()->default(null)->comment('cover image');
            $table->string('image_sm', 255)->nullable()->default(null)->comment('cover image');
            $table->integer('item_img_width')->nullable()->default(null);
            $table->integer('item_img_height')->nullable()->default(null);
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
        Schema::dropIfExists('galleries');
    }
};
