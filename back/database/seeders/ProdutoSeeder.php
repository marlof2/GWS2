<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Cobre',
            'Medidor',
            'Medidor Telemetria',
        ];


        foreach ($datas as $data) {
            Product::firstOrCreate([
                "nome" => "$data",
                "quantidade" => 100
            ]);
        }
    }
}
