<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Client;
use App\Models\Company;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('describe')->nullable();
            $table->double('budget');
            $table->double('total_price');
            $table->double('profit');
            $table->string('image')->nullable();
            $table->date('start_time');
            $table->date('end_time');
            $table->enum('status', ['in_progress', 'Cancel ', 'finish', ' reject'])->default('in_progress');
            $table->foreignId('supervisor_id')->references('id')->on('users');
            $table->foreignId('team_id')->references('id')->on('teams');
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
        Schema::dropIfExists('projects');
    }
}
