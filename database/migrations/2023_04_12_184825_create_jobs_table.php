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
            $table->string('title')->nullable();
            $table->text('instruction')->nullable();
            $table->date('start_day')->nullable();
            $table->date('end_day')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->double('subtotal')->nullable();
            $table->string('arrival_window')->nullable();
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->foreignId('company_id')->references('id')->on('companies');

            $table->foreignId('project_id')->references('id')->on('projects');
//            $table->foreignId('team_id')->references('id')->on('teams');
            $table->foreignId('employee_id')->references('id')->on('employees');
            $table->decimal('total_value', 8, 2)->nullable();
            $table->decimal('total_expenses', 8, 2)->nullable();
            $table->decimal('total_salaries', 8, 2)->nullable();
            $table->string('in_progress')->nullable();

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
