<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocialiteUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialite_users', function (Blueprint $table) {
            $table->increments('socialite_user_id');

            $table->unsignedInteger('user_id')->comment('关联用户id');
            $table->string('provider')->index()->comment('第三方类型');
            $table->bigInteger('provider_user_id')->comment('第三方id');
            $table->json('oauth_data')->nullable()->comment('OAUTH数据');
            $table->timestamp('expires_at')->nullable()->comment('过期日期');

            $table->unsignedInteger('created_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->ipAddress('created_ip')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->ipAddress('updated_ip')->nullable();

            $table->unique(['user_id', 'provider']);
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('socialite_users');
    }
}
