<?php

namespace Database\Seeders;

use App\Models\Papel;
use Illuminate\Database\Seeder;

class PapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Papel::firstOrCreate([
            'nome' => 'Admin',
            'descricao' => 'Acesso total ao sistema'
        ]);

        $p2 = Papel::firstOrCreate([
            'nome' => 'Gerente',
            'descricao' => 'Gerenciamento do sistema'
        ]);

        $p3 = Papel::firstOrCreate([
            'nome' => 'Usuario',
            'descricao' => 'Acesso ao site como usuário'
        ]);
    }
};
