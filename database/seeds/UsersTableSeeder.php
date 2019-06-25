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
            'name' => 'emanuel',
            'email' => 'emanuel@mail',
            'password' => '123123'
        ]);
        \App\User::create([
            'name' => 'leo',
            'email' => 'leo@mail',
            'password' => '123123'
        ]);
    }
}
