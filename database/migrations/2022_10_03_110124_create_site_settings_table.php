<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('logo');
            $table->string('favicon');
            $table->string('banner_image');
            $table->json('social_links')->default('[]');
            $table->json('stripe')->default('[]');
            $table->json('footer_links')->default('[]');
            $table->json('smtp')->default('[]');
            $table->double('credit_conversion')->default(0);
            $table->double('credit_per_job_post')->default(0);
            $table->string('copy_right_text');
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
        Schema::dropIfExists('site_settings');
    }
}
