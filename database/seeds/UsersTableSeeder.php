<?php

use Illuminate\Database\Seeder;

class TipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        // seed de users
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
