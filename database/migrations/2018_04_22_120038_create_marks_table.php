<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function ($table)
        {
            $table->integer('percentage')->default(null);
        });
        Schema::create('marks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->references('id')->on('lessons');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('value');
            $table->string('notes')->default(null);
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
        Schema::table('lesson', function ($table)
        {
            $table->dropColumn('percentage');
        });
        Schema::dropIfExists('marks');
    }
}
