<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferpricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offerprices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('massage');
            $table->string('client_signature');
            $table->string('company_signature');
            $table->string('image');
            $table->date('date');
            $table->enum('status', ['in_progress', 'canceled', 'completed', 'approval']);
            $table->integer('count');
            $table->double('total_price');
            $table->double('discount');
            $table->double('tax');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->foreignId('clint_id')->references('id')->on('clients');
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
        Schema::dropIfExists('offerprices');
    }
}
