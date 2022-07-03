<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Client::firstOrCreate([
            'nome' => 'Marlo',
            'cpf_cnpj' => '03296244581',
            'complemento' => 'Perto da rua A',
            'telefone' => '71991717209',
        ]);
    }
}
