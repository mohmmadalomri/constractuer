<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message');
            $table->text('offer_price_massage');
            $table->double('subtotal');
            $table->double('discount');
            $table->string('type_discount');
            $table->string('image');
            $table->string('tax_name');
            $table->text('tax_describe');
            $table->double('tax_rate');
            $table->double('total');
            $table->date('date');
            $table->text('note');
            $table->enum('status',['in_progress','canceled','completed','approved'])->default('in_progress');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->foreignId('item_id')->references('id')->on('items');
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
        Schema::dropIfExists('quotes');
    }
}
