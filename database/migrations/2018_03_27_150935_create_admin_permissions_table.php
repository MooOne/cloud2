<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('yeelight.backend.database.connection') ?: config('database.default');

        Schema::connection($connection)->create(config('yeelight.backend.database.admin_permissions_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50);
            $table->string('http_method')->nullable();
            $table->text('http_path')->nullable();
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

        Schema::connection($connection)->dropIfExists(config('yeelight.backend.database.admin_permissions_table'));
    }
}
