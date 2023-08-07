<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->date('issued_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('payment')->nullable();
            $table->text('message')->nullable();
            $table->double('subtotal')->nullable();
            $table->double('payment_due')->nullable();
            $table->double('total')->nullable();
            $table->enum('status', ['cancellation', 'in_progress', 'expiration ', 'disapproval'])->default('in_progress');


            $table->bigInteger('tax_id')->unsigned()->nullable();
            $table->foreign('tax_id')->references('id')->on('taxes')->onDelete('cascade');

//            $table->bigInteger('paymentSchedule_id')->unsigned()->nullable();
//            $table->foreign('paymentSchedule_id')->references('id')->on('paymentschedules')->onDelete('cascade');

            $table->bigInteger('signature_id')->unsigned()->nullable();
            $table->foreign('signature_id')->references('id')->on('signatures');

            $table->bigInteger('request_id')->unsigned()->nullable();
            $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');

            $table->bigInteger('discount_id')->unsigned()->nullable();
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');

            $table->foreignId('company_id')->references('id')->on('companies');
            $table->foreignId('client_id')->references('id')->on('clients');

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
        Schema::dropIfExists('invoices');
    }
}
