<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    
    public function up()
    {
        Schema::create('sales',function(Blueprint $table){
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity');
            $table->double('interests');
            $table->double('subtotal');
            $table->double('total');
            $table->double('realinitpay');
            $table->double('remaing');
            $table->double('remaing_interests');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::drop('sales');
    }
}
