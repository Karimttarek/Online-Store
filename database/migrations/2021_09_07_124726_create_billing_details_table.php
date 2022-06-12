<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billingDetails', function (Blueprint $table) {
            $table->id();
            $table->integer('hdrId');
            $table->integer('product_id');
            $table->string('product_name');
            $table->bigInteger('qty');
            $table->decimal('price' ,18,3);
            $table->decimal('productTax' ,18,3)->nullable();
            $table->decimal('productDiscount' ,18,3)->nullable();
            $table->decimal('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billingDetails');
    }
}
