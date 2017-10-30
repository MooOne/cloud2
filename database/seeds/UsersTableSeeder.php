<?php

use Illuminate\Database\Seeder;
use Yeelight\Models\Foundation\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        User::create([
//            'slid' => '1',
            'name' => "Sheldon Lee",
            'email' => 'xdlee@gmail.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
            'gender' => 'M',
            'birthday' => '1989-05-24',
            'country' => 'CN',
            'timezone' => 'Asia/Shanghai',
            'locale' => 'en',
            'username' => 'sheldon',
            'phone_number' => '+18888888888',
            'status' => 1,
        ]);

        //factory(User::class, 50)->create();
    }
}
