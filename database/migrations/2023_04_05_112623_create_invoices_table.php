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
            $table->string('title');
            $table->string('logo');
            $table->date('issued_date');
            $table->date('due_date');
            $table->string('payment');
            $table->text('message')->nullable();
            $table->double('subtotal');
            $table->double('discount');
            $table->double('payment_due');
            $table->string('type_discount');
            $table->string('tax_name');
            $table->text('tax_describe');
            $table->double('tax_rate');
            $table->double('total');
            $table->enum('status', ['cancellation', 'in_progress', 'expiration ', 'disapproval'])->default('in_progress');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->foreignId('client_id')->references('id')->on('clients');
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
