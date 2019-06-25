<?php

use Illuminate\Database\Seeder;

class MissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed de missoes
        \App\Mission::create([
            'name' => 'Fazer 3 viagens',
            'xp' => 300,
            'typeOfMission' => 'viagens',
            'finalResult' => 3,
        ]);
        \App\Mission::create([
            'name' => 'Fazer 1 viagens',
            'xp' => 100,
            'typeOfMission' => 'viagens',
            'finalResult' => 1,
        ]);

        \App\Mission::create([
            'name' => 'Levar 1 produto numa viagem',
            'xp' => 100,
            'typeOfMission' => 'produtoPorViagem',
            'finalResult' => 1,
        ]);
        \App\Mission::create([
            'name' => 'Levar 3 produto numa viagem',
            'xp' => 300,
            'typeOfMission' => 'produtoPorViagem',
            'finalResult' => 3,
        ]);

        \App\Mission::create([
            'name' => 'Levar 1 produto',
            'xp' => 100,
            'typeOfMission' => 'produto',
            'finalResult' => 1,
        ]);
        \App\Mission::create([
            'name' => 'Levar 3 produto numa viagem',
            'xp' => 300,
            'typeOfMission' => 'produto',
            'finalResult' => 3,
        ]);


    }
}
