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
            $table->integer('user_id');
            $table->integer('company_id')->nullable();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('start_time');
            $table->string('name');
            $table->string('description');
            $table->string('email');
            $table->string('phone');
            $table->string('post_code');
            $table->enum('status', ['pending', 'replied', 'complete'])->default('pending');
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
