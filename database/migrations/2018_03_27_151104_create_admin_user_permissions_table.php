<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('yeelight.backend.database.connection') ?: config('database.default');

        Schema::connection($connection)->create(config('yeelight.backend.database.admin_user_permissions_table'), function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('permission_id');
            $table->index(['user_id', 'permission_id']);
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

        Schema::connection($connection)->dropIfExists(config('yeelight.backend.database.admin_user_permissions_table'));
    }
}
