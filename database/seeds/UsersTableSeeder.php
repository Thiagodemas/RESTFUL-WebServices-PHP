<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'      => 'Thiago Demas',
            'email'     => 'thiago.demas7@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
    }
}
