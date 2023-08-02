<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesPaymentschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_paymentschedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paymentSchedule_id')->unsigned()->nullable();
            $table->foreign('paymentSchedule_id')->references('id')->on('paymentschedules')->onDelete('cascade');
            $table->bigInteger('invoice_id')->unsigned()->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
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
        Schema::dropIfExists('invoices_paymentschedules');
    }
}
