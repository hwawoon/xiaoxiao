<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::create(
            array(
                'email' => 'kimhwawoon@gmail.com',
                'name' => 'kimhwawoon',
                'password' => \Illuminate\Support\Facades\Hash::make('gaoxiaowa'),
                'is_admin' => 1
            )
        );

    }
} 