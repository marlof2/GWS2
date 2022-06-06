<?php

namespace Database\Seeders;

use App\Models\Descriptions;
use Illuminate\Database\Seeder;

class DescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $description = [
        //     'descricao' => 'KIT GÁS + FORNO',
        //     'descricao' => 'KIT GÁS',
        //     'descricao' => 'DESLOCAMENTO DE PONTO',
        //     'descricao' => 'REDUÇÃO DE PONTO',
        //     'descricao' => 'INSTALAÇÃO DE MANGUEIRA FORNO',
        //     'descricao' => 'INSTALAÇÃO DE MANGUEIRA FOGÃO COM VALVULA',
        //     'descricao' => 'INSTALAÇÃO DE MANGUEIRA FOGÃO SEM VALVULA',
        //     'descricao' => 'OUTROS',
        //     'descricao' => 'KIT GÁS (TELEMETRIA)',
        //     'descricao' => 'KIT GÁS + FORNO (TELEMETRIA)',
        // ];

        $description = [
            'KIT GÁS + FORNO',
            'KIT GÁS',
            'DESLOCAMENTO DE PONTO',
            'REDUÇÃO DE PONTO',
            'INSTALAÇÃO DE MANGUEIRA FORNO',
            'INSTALAÇÃO DE MANGUEIRA FOGÃO COM VALVULA',
            'INSTALAÇÃO DE MANGUEIRA FOGÃO SEM VALVULA',
            'OUTROS',
            'KIT GÁS (TELEMETRIA)',
            'KIT GÁS + FORNO (TELEMETRIA)',
        ];

        foreach ($description as $value) {
            Descriptions::create(
                [
                    'descricao' => $value,
                ]
            );
        }
    }
}
