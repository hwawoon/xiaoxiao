<?php
/**
 * Created by PhpStorm.
 * User: kimi
 * Date: 13-12-30
 * Time: 下午11:30
 */

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::create(
            array(
                'email' => 'hwawoon@163.com',
                'name' => 'hwawoon',
                'password' => '123456'
            )
        );

        User::create(
            array(
                'email' => 'kimhwawoon@gmail.com',
                'name' => 'kimhwawoon',
                'password' => '123456'
            )
        );

    }
} 