<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('author', 100);
            $table->string('slug', 200)->nullable();
            $table->text('desc', 6000)->nullable();
            $table->text('content', 6000);
            $table->string('thumb', 200)->nullable();
            $table->enum('post_cat', ['news', 'game'])->nullable();
            $table->enum('status', ['wait', 'active'])->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
