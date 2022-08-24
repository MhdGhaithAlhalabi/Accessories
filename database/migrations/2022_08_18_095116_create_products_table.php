<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name')->unique();
            $table->longText('details')->nullable();
            $table->float('price');
            $table->float('priceSale')->nullable();
            $table->string('status')->nullable();
            $table->double('rate')->nullable();
            $table->foreignId('type_id');
            $table->foreignId('category_id');
            $table->string('has_name');
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
};
