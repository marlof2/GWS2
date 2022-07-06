<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DescriptionSeeder::class,
            PermissaoSeeder::class,
            PapelSeeder::class,
            UserSeeder::class,
            ProdutoSeeder::class,
            CondominioSeeder::class,
            FormaPagamentoSeeder::class,
            ClienteSeeder::class,
            ProgramacaoSeeder::class,
            ProgramacaoProdutosSeeder::class,
        ]);
    }
}
