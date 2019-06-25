<?php

use Illuminate\Database\Seeder;

class TipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed de tipos de viagens
        \App\Tipo::create([
          'tipoViagem' => 'viagem criada',
        ]);

        \App\Tipo::create([
          'tipoViagem' => 'pedido viagem',
        ]);

        // seed de estados
        \App\Estado::create([
          'estado' => 'pendente',
        ]);

        \App\Estado::create([
          'estado' => 'em viagem',
        ]);

        \App\Estado::create([
          'estado' => 'concluida',
        ]);

        \App\Estado::create([
          'estado' => 'avaliada',
        ]);

        // // seed de users
        // \App\User::create([
        //   'name' => 'emanuel',
        //   'email' => 'emanuel@mail',
        //   'password' => '123123'
        // ]);
        // \App\User::create([
        //     'name' => 'leo',
        //     'email' => 'leo@mail',
        //     'password' => '123123'
        // ]);
    }
}
