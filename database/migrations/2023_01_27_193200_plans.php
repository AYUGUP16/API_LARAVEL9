<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Plans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->integer('mrp');
            $table->string('validity');
            $table->string('total_data');
            $table->string('speed');
            $table->string('voice');
            $table->string('sms');
            $table->string('other_addon');
            $table->unsignedInteger('subs_id');
            $table->foreign('subs_id')->references('id')->on('subscription');
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
        //
    }
}
