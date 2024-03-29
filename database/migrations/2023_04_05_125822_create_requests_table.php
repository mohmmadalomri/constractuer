<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('instruction');
            $table->timestamp('day');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->foreignId('team_id')->references('id')->on('teams');
            $table->foreignId('company_id')->references('id')->on('companies');

            $table->foreignId('project_id')->references('id')->on('projects');
            $table->foreignId('task_id')->references('id')->on('tasks');
            $table->string('request_adress');
            $table->timestamp('booking_request');
            $table->string('notes');
            $table->foreignId('item_id')->references('id')->on('items');
            $table->decimal('service_price', 8, 2)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
