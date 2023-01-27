<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_models', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable(); 
            $table->text('content')->nullable(); 
            $table->string('image')->nullable(); 
            $table->string('bg_image')->nullable(); 
            $table->string('page_name')->nullable(); 
            $table->string('type')->nullable(); 
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages_models');
    }
}
