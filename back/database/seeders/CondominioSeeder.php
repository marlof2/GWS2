<?php

namespace Database\Seeders;

use App\Models\Condominium;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CondominioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Vila dos Coraes',
            'Baleias',
            'Solar do Atlantico',
        ];


        foreach ($datas as $data) {
            Condominium::firstOrCreate([
                "nome" => "$data",
            ]);
        }
    }
}
