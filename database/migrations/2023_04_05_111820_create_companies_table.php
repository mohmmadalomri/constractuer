<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique;
            $table->string('logo');
            $table->text('email');
            $table > date('date_of_created')->nullable();
            $table->text('phone');
            $table->string('link_website')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_twitter')->nullable();
            $table->string('link_youtube')->nullable();
            $table->string('link_linkedin')->nullable();
            $table->string('specialization');
            $table->enum('company_description', ['small_company', 'medium_company', 'large_company']);
            $table->enum('company_size', ['2-3', '4-10', 'more_than10']);
            $table->enum('priorities', ['work_tracking', 'save_business',
                ' work_management ', 'expand_work', 'professionalism', 'otherwise']);
            $table->string(' hear_about_us');
            $table->string('address_1');
            $table->string('address_2')->nullable();  // عنوان اخر
            $table->string('country');          //الدوله

            $table->string('governorate');  // المقاطعة او المحافظة
            $table->string('city');         // المدينة
            $table->string('zip_code');     // رمز البريد
            $table->foreignId('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('companies');
    }
}
