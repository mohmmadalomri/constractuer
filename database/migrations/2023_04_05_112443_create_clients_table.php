<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name_company')->nullable();
            $table->text('Main_phone')->nullable();
            $table->text('work_phone')->nullable();
            $table->text('mobile_phone')->nullable();
            $table->text('home_phone')->nullable();
            $table->text('fax_phone')->nullable();
            $table->text('other_phone')->nullable();
            $table->text('Main_email')->nullable();
            $table->text('work_email')->nullable();
            $table->text('personal_email')->nullable();
            $table->text('home_email')->nullable();
            $table->text('other_email')->nullable();
            $table->string('link_website')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_twitter')->nullable();
            $table->string('link_youtupe')->nullable();
            $table->string('link_linkedin')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_linkedin')->nullable();
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('country');
            $table->string('governorate');
            $table->string('city');
            $table->string('zip_code');
            $table->enum('status', ['obligated ', 'not_obligated ']);
            $table->foreignId('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('clients');
    }
}
