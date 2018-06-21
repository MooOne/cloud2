<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_models', function (Blueprint $table) {
            $table->increments('product_model_id');
            $table->unsignedInteger('user_id')->index();

            // Adding more table related fields here...
            $table->string('title')->comment('产品中文名');
            $table->string('model_name')->comment('产品型号');
            $table->string('code')->comment('代号');
            $table->tinyInteger('status')->default('1')->comment('状态');

            $table->unsignedInteger('created_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->ipAddress('created_ip')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->ipAddress('updated_ip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_models');
    }
}
