<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('instruction');
            $table->timestamp('start_day');
            $table->timestamp('end_day');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->double('subtotal');
            $table->string('arrival_window');
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->foreignId('company_id')->references('id')->on('companies');

            $table->foreignId('project_id')->references('id')->on('projects');
            $table->foreignId('team_id')->references('id')->on('teams');
            $table->foreignId('employee_id')->references('id')->on('employees');
            $table->foreignId('item_id')->references('id')->on('items');
            $table->decimal('total_value', 8, 2)->nullable();
            $table->decimal('total_expenses', 8, 2)->nullable();
            $table->decimal('total_salaries', 8, 2)->nullable();
            $table->string('in_progress');

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
        Schema::dropIfExists('jobs');
    }
}
