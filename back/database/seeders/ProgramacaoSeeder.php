<?php

namespace Database\Seeders;

use App\Models\Programation;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class ProgramacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Programation::firstOrCreate([
            'user_id' => 2,
            'condominium_id' => 1,
            'client_id' => 1,
            'forma_pagamento_id' => 1,
            'valor' => "100",
            'situacao' => 'A',
            'descricao' => 'KIT GAS',
            'garantia' => '1',
            'data' => "2022-07-04",
            'hora' => " 00:00:00",
        ]);

        Programation::firstOrCreate([
            'user_id' => 2,
            'condominium_id' => 2,
            'client_id' => 1,
            'forma_pagamento_id' => 2,
            'valor' => "50",
            'situacao' => 'N',
            'descricao' => 'KIT GAS',
            'garantia' => '1',
            'data' => "2022-07-04",
            'hora' => " 00:00:00",
        ]);
    }
}
