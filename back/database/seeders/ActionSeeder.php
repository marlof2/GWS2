<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Action::create(
            [
                'nome' => 'Criar',
            ]
        );

        Action::create(
            [
                'nome' => 'Editar',
            ]
        );

        Action::create(
            [
                'nome' => 'Deletar',
            ]
        );

        Action::create(
            [
                'nome' => 'Consultar',
            ]
        );
    }
}
