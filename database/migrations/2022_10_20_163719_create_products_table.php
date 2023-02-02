<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name", 150);
            $table->string("price", 30);
            $table->string("price_old", 30)->nullable();
            $table->string("code", 10);
            $table->string("cat_id", 10)->nullable();
            $table->text("desc", 5000);
            $table->text("content", 5000);
            $table->string("cpu", 150);
            $table->string("ram", 150);
            $table->string("rom", 150);
            $table->string("weight", 150);
            $table->string("display", 150);
            $table->string("slug", 150);
            $table->string("opera", 50);
            $table->string("trandmake", 200);
            $table->string("thumb_1", 200);
            $table->string("thumb_2", 200);
            $table->string("thumb_3", 200);
            $table->string("thumb_4", 200);
            $table->string("avatar", 200);
            $table->enum("cat_product", ['laptop','mobile','smartwatch']);
            $table->enum("state", ['state1', 'state2']);
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
        Schema::dropIfExists('products');
    }
}
