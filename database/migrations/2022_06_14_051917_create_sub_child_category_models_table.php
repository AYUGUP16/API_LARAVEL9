<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubChildCategoryModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_child_category_models', function (Blueprint $table) {
            $table->id();
            $table->string('subchild_name');
            $table->string('subchild_slug');
            $table->string('subchild_child_id');
            $table->string('subchild_parent_id');
            $table->string('subchild_icon');
            $table->string('subchild_status');
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
        Schema::dropIfExists('sub_child_category_models');
    }
}
