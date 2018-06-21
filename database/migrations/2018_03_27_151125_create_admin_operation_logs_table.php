<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminOperationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('yeelight.backend.database.admin_operation_logs_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip', 15);
            $table->text('input');
            $table->index('user_id');
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
        Schema::dropIfExists(config('yeelight.backend.database.admin_operation_logs_table'));
    }
}
