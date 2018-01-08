<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('videos', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->string('link', 255);
            $table->text('video');
            $table->text('description');
            $table->timestamps();
            //
        });
   }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		
		Schema::drop('videos');
	}
}
