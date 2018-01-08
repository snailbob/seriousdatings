<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
		
		 Schema::create('banners', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->string('sub_title', 255);
			$table->string('link', 255);
            $table->text('image');
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
       Schema::drop('banners');
    }
}
