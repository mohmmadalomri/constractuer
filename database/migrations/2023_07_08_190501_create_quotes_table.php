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
            $table->string('title')->nullable();
            $table->text('message')->nullable();
            $table->text('offer_price_massage')->nullable();
            $table->double('subtotal')->nullable();
            $table->string('image')->nullable();
            $table->double('total');
            $table->date('date');
            $table->text('note');
            $table->enum('status',['in_progress','canceled','completed','approved'])->default('in_progress');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->foreignId('client_id')->references('id')->on('clients');

            $table->bigInteger('discount_id')->unsigned()->nullable();
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');

            $table->bigInteger('signature_id')->unsigned()->nullable();
            $table->foreign('signature_id')->references('id')->on('signatures');

            $table->bigInteger('tax_id')->unsigned()->nullable();
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade');

            $table->enum('payment_type', ['$', '%'])->default('$')->nullable();

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
