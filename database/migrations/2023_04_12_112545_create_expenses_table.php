<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('accounting_code');
            $table->string('image');
            $table->text('describe');
            $table->date('date');
            $table->double('value');
            $table->enum('status', ['under_review', 'approved', 'cancellation', ' in_progress'])->default('under_review');
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->foreignId('project_id')->references('id')->on('projects');
            $table->foreignId('task_id')->references('id')->on('tasks');
            $table->foreignId('job_id')->references('id')->on('jobs');
            $table->foreignId('team_id')->references('id')->on('teams');
            $table->foreignId('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('expenses');
    }
}
