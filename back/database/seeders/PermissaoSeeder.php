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
        $usuarios1 = Permissao::firstOrCreate([
            'nome' => 'usuario-view',
            'descricao' => 'Acesso a lista de Usuários'
        ]);
        $usuarios2 = Permissao::firstOrCreate([
            'nome' => 'usuario-create',
            'descricao' => 'Adicionar Usuários'
        ]);
        $usuarios2 = Permissao::firstOrCreate([
            'nome' => 'usuario-edit',
            'descricao' => 'Editar Usuários'
        ]);
        $usuarios3 = Permissao::firstOrCreate([
            'nome' => 'usuario-delete',
            'descricao' => 'Deletar Usuários'
        ]);

        $perfil1 = Permissao::firstOrCreate([
            'nome' => 'perfil-view',
            'descricao' => 'Acesso ao perfil'
        ]);

        $produtos1 = Permissao::firstOrCreate([
            'nome' => 'produtos-view',
            'descricao' => 'Acesso aos produtos'
        ]);

        $produtos2 = Permissao::firstOrCreate([
            'nome' => 'produtos-create',
            'descricao' => 'Acesso aos produtos'
        ]);
        $produtos3 = Permissao::firstOrCreate([
            'nome' => 'produtos-edit',
            'descricao' => 'Acesso aos produtos'
        ]);
        $produtos4 = Permissao::firstOrCreate([
            'nome' => 'produtos-delete',
            'descricao' => 'Acesso aos produtos'
        ]);


        $condominio1 = Permissao::firstOrCreate([
            'nome' => 'condominio-view',
            'descricao' => 'Acesso aos condominio'
        ]);

        $condominio2 = Permissao::firstOrCreate([
            'nome' => 'condominio-create',
            'descricao' => 'Acesso aos condominio'
        ]);
        $condominio3 = Permissao::firstOrCreate([
            'nome' => 'condominio-edit',
            'descricao' => 'Acesso aos condominio'
        ]);
        $condominio4 = Permissao::firstOrCreate([
            'nome' => 'condominio-delete',
            'descricao' => 'Acesso aos condominio'
        ]);

        $programacao1 = Permissao::firstOrCreate([
            'nome' => 'programacao-view',
            'descricao' => 'Acesso aos programacao'
        ]);

        $programacao2 = Permissao::firstOrCreate([
            'nome' => 'programacao-create',
            'descricao' => 'Acesso aos programacao'
        ]);
        $programacao3 = Permissao::firstOrCreate([
            'nome' => 'programacao-edit',
            'descricao' => 'Acesso aos programacao'
        ]);
        $programacao4 = Permissao::firstOrCreate([
            'nome' => 'programacao-delete',
            'descricao' => 'Acesso aos programacao'
        ]);


        $papeis1 = Permissao::firstOrCreate([
            'nome' => 'papel-view',
            'descricao' => 'Listar Papéis'
        ]);
        $papeis2 = Permissao::firstOrCreate([
            'nome' => 'papel-create',
            'descricao' => 'Adicionar Papéis'
        ]);
        $papeis3 = Permissao::firstOrCreate([
            'nome' => 'papel-edit',
            'descricao' => 'Editar Papéis'
        ]);

        $papeis4 = Permissao::firstOrCreate([
            'nome' => 'papel-delete',
            'descricao' => 'Deletar Papéis'
        ]);
    }
}
