<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateYeelightImageHashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yeelight_image_hashes', function (Blueprint $table) {
            $table->increments('yeelight_image_hash_id');
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->unsignedInteger('yeelight_image_id')->index();
            $table->char('file_sha1', 40);
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
        Schema::drop('yeelight_image_hashes');
    }
}
