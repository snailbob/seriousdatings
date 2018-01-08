<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadyDateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ready_date_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('question');
            $table->string('continuetext');
            $table->string('lowest_text');
            $table->string('middle_text');
            $table->string('highest_text');
            $table->longText('choices');
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
        Schema::drop('ready_date_questions');
    }
}
