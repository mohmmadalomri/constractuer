<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Project;
use App\Models\Team;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('describe');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->string('status');
            $table->string('location');
            $table->foreignId('project_id')->references('id')->on('projects');
            $table->foreignId('team_id')->references('id')->on('teams');

            $table->foreignId('client_id')->references('id')->on('clients');
            $table->decimal('total_price', 8, 2)->nullable();
            $table->decimal('total_expenses', 8, 2)->nullable();
            $table->decimal('total_value', 8, 2)->nullable();

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
        Schema::dropIfExists('tasks');
    }
}
