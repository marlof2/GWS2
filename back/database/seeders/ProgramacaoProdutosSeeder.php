<?php

namespace Database\Seeders;

use App\Models\ProgramationProduct;
use Illuminate\Database\Seeder;


class ProgramacaoProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProgramationProduct::firstOrCreate([
            'programation_id' => 1,
            'product_id' => 1,
            'quantidade' => 10,
        ]);
        
        ProgramationProduct::firstOrCreate([
            'programation_id' => 1,
            'product_id' => 2,
            'quantidade' => 10,
        ]);

        ProgramationProduct::firstOrCreate([
            'programation_id' => 1,
            'product_id' => 3,
            'quantidade' => 10,
        ]);

        ProgramationProduct::firstOrCreate([
            'programation_id' => 2,
            'product_id' => 1,
            'quantidade' => 10,
        ]);

        ProgramationProduct::firstOrCreate([
            'programation_id' => 2,
            'product_id' => 2,
            'quantidade' => 10,
        ]);

        ProgramationProduct::firstOrCreate([
            'programation_id' => 2,
            'product_id' => 3,
            'quantidade' => 10,
        ]);

    }
}
