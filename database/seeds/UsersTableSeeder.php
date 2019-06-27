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
            'password' => Hash::make('123123')
        ]);
        \App\User::create([
            'name' => 'leo',
            'email' => 'leo@mail',
            'password' => Hash::make('123123')
        ]);
    }
}
