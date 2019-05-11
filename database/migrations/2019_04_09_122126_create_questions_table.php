<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('title', 191)->nullable();
            $table->boolean('question_poll');
            $table->longText('details');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->nullable();
            $table->string('filename')->nullable();
            $table->boolean('is_solved')->default(0);
            $table->integer('reports')->default(0);
            $table->tinyInteger('approve_status')->default(0);
            $table->integer('verify_author')->nullable();
            $table->longText('note')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('questions');
    }
}
