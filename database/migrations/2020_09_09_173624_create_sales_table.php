<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->integer('invoice');
            $table->string('sale_men');
            $table->dateTime('date_time')->nullable();
            $table->integer('table_no');
            $table->integer('kot_no');
            $table->string('products');
            $table->integer('qty');
            $table->string('service');
            $table->string('gst');
            $table->string('discount')->nullable();
            $table->decimal('total', 10, 2);
            $table->decimal('g_total', 10, 2);
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
        Schema::dropIfExists('sales');
    }
}
