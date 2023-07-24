<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_items', function (Blueprint $table) {
            $table->foreignId('invoice_id')->references('id')->on('invoices');
            $table->foreignId('item_id')->references('id')->on('items');
            $table->string('quantity')->nullable();
            $table->string('tax')->nullable();
            $table->string('price')->nullable();
            $table->string('total_Price')->nullable();
            #nullable->
            #quantity
            #tax
            #price
            #total_Price

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices_items');
    }
}
