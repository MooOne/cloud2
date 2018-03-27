<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminOperationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('yeelight.backend.database.connection') ?: config('database.default');

        Schema::connection($connection)->create(config('yeelight.backend.database.admin_operation_log_table'), function (Blueprint $table) {
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
        $connection = config('yeelight.backend.database.connection') ?: config('database.default');

        Schema::connection($connection)->dropIfExists(config('yeelight.backend.database.admin_operation_log_table'));
    }
}
