<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable();
            $table->text('title')->nullable();
            $table->string('image', 64)->nullable();
            $table->boolean('show_image')->default(1);
            $table->text('content')->nullable();
            $table->string('static', 64)->nullable();
            $table->boolean('to_menu')->default(1);
            $table->boolean('active')->default(1);
            $table->integer('sort')->unsigned()->default(0);
            $table->timestamps();
            $table->engine = 'MyISAM';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
