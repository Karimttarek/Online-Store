<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billingHeader', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->tinyInteger('paymentType')->default(0)->nullable();
            $table->decimal('hdrTax',18,3)->nullable();
            $table->decimal('hdrDiscount',18,3)->nullable();
            $table->decimal('hdrSubTotal' ,18,3);
            $table->decimal('hdrTotal' ,18,3);
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
        Schema::dropIfExists('billingHeader');
    }
}
