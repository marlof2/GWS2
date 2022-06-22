<?php

namespace Database\Seeders;

use App\Models\Permissao;
use Illuminate\Database\Seeder;

class PermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Usuario',
            'Produto',
            'Condominio',
            'Programacao',
            'Papel',
        ];


        foreach ($datas as $data) {
            Permissao::firstOrCreate([
                "nome" => "$data-view",
                "descricao" => "Listar $data"
            ]);

            Permissao::firstOrCreate([
                "nome" => "$data-create",
                'descricao' => "Adicionar $data"
            ]);

            Permissao::firstOrCreate([
                "nome" => "$data-edit",
                'descricao' => "Editar $data"
            ]);

            Permissao::firstOrCreate([
                "nome" => "$data-delete",
                'descricao' => "Deletar $data"
            ]);
        }
    }
}
