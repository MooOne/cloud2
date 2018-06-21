<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');

            // Adding more table related fields here...
            $table->string('name', 50)->nullable()->comment('用户昵称');
            $table->char('gender', 1)->nullable()->comment('性别');
            $table->date('birthday')->nullable()->comment('生日');
            $table->char('country', 2)->nullable()->default('CN')->comment('国家');
            $table->string('timezone', 30)->nullable()->default('Asia/Shanghai')->comment('时区');
            $table->string('locale', 15)->nullable()->default('zh')->comment('语言');
            $table->string('username', 50)->unique()->comment('用户名');
            $table->string('phone_number')->nullable()->comment('手机号码');
            $table->string('email', 150)->nullable()->unique()->comment('邮箱');
            $table->string('password', 190)->nullable()->comment('密码');
            $table->rememberToken();
            $table->tinyInteger('status')->comment('状态')->default(1);

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
        Schema::drop('users');
    }
}
