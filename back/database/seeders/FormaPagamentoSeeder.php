<?php

namespace Database\Seeders;

use App\Models\FormaPagamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormaPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Cartão de Crédito',
            'Cartão de Débito',
            'Dinheiro',
            'Pix',
        ];


        foreach ($datas as $data) {
            FormaPagamento::firstOrCreate([
                "nome" => "$data",
            ]);
        }
    }
}
