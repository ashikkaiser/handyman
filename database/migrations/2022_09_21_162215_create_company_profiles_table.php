<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('credit')->default(0);
            $table->string('business_name');
            $table->string('business_description')->nullable();
            $table->string('business_email');
            $table->string('business_phone');
            $table->string('business_type');
            $table->string('business_employee_size');
            $table->string('business_category');
            $table->json('business_subcategory');
            $table->string('package_id');
            $table->string('business_address1');
            $table->string('business_address2');
            $table->string('business_town');
            $table->string('business_country');
            $table->string('business_postal_code');
            $table->string('business_latitude')->nullable();
            $table->string('business_longitude')->nullable();
            $table->string('business_url')->nullable();
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('date_of_birth');
            $table->string('map_address')->nullable();
            $table->boolean('verified')->default(0);
            $table->dateTime('payment_date')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->boolean('is_active')->default(false);
            $table->json('images')->nullable()->default(json_encode([]));
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
        Schema::dropIfExists('company_profiles');
    }
}
