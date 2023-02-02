<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsCatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_cat', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->enum('cat_parent', ['laptop','mobile','smartwatch']);
            $table->enum('state', ['state1','state2']);
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
        Schema::dropIfExists('products_cat');
    }
}
