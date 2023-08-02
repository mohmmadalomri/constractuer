<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesPaymentschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes_paymentschedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paymentSchedule_id')->unsigned()->nullable();
            $table->foreign('paymentSchedule_id')->references('id')->on('paymentschedules')->onDelete('cascade');
            $table->bigInteger('quote_id')->unsigned()->nullable();
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
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
        Schema::dropIfExists('quotes_paymentschedules');
    }
}
