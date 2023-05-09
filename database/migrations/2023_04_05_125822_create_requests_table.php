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
            $table->unsignedBigInteger('client_id');
            $table->string('title');
            $table->timestamp('day');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->unsignedBigInteger('team_id');
            $table->string('instruction');
            $table->unsignedBigInteger('company_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('company_id')->references('id')->on('companies');
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
