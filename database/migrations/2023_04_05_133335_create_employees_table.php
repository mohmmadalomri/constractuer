<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('password');
            $table->string('email');
            $table->integer('phone');
            $table->date('breath_day');
            $table->enum('status', ['supervisor', 'employee', 'not_employee'])->default('employee');
            $table->double('hourly_salary')->default(0);
            $table->double('monthly_salary')->default(0);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->foreignId('profession_id')->references('id')->on('professions');
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
        Schema::dropIfExists('employees');
    }
}
