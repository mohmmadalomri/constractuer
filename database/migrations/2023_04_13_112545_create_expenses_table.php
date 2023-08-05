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
            $table->string('title')->nullable();
            $table->string('accounting_code');
            $table->string('image')->nullable();
            $table->text('describe')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->double('value')->nullable();
            $table->enum('status', ['under_review', 'approved', 'cancellation', ' in_progress'])->default('under_review');
            $table->foreignId('client_id')->references('id')->on('clients');

            $table->string('address')->nullable();
            $table->string('job_title')->nullable();
            $table->string('in_progress')->nullable();


            $table->decimal('total_expenses', 8, 2)->nullable();
            $table->decimal('total_salary_paid', 8, 2)->nullable();

            $table->bigInteger('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->bigInteger('task_id')->unsigned()->nullable();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->bigInteger('team_id')->unsigned()->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreignId('job_id')->references('id')->on('jobs');
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
