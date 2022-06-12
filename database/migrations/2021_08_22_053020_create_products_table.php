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
            $table->string('code');
            $table->string('sku')->nullable();
            $table->string('name')->unique();
            $table->string('name_ar')->unique();
            $table->string('description',999)->nullable();
            $table->integer('productType')->nullable();
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->decimal('price' , 18 ,3);
            $table->decimal('tax' , 18 ,3)->nullable()->default(0);
            $table->decimal('discount' , 18 ,3)->nullable()->default(0);
            $table->integer('stock')->nullable()->default(0);
            $table->boolean('active')->default(1);
            $table->string('entry')->nullable();
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
        Schema::dropIfExists('products');
    }
}
