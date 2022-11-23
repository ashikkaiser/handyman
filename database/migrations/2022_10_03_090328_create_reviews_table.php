<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('company_id');
            $table->boolean('carried_out')->default(0);
            $table->integer('category_id')->nullable();
            $table->text('job_name')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->text('review_title')->nullable();
            $table->text('review');
            $table->text('phone');
            $table->integer('workmanship')->nullable();
            $table->integer('tidiness')->nullable();
            $table->integer('reliability')->nullable();
            $table->integer('courtesy')->nullable();
            $table->integer('overall')->nullable();
            $table->integer('final_price')->nullable();
            $table->integer('value_of_work')->nullable();
            $table->boolean('recommend')->default(0);
            $table->boolean('published')->default(true);
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
        Schema::dropIfExists('reviews');
    }
}
