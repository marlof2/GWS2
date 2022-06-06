<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create(
            [
                'nome' => 'Aministrador',
            ]
        );
        
        Profile::create(
            [
                'nome' => 'Usuário',
            ]
        );

        Profile::create(
            [
                'nome' => 'Direitor',
            ]
        );
    }
}
