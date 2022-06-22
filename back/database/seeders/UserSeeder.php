<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use App\Models\Papel;
use App\Models\PapelPermissao;
use App\Models\PapelUser;
use App\Models\Permissao;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $usuarios = collect([]);


        $usuario = User::firstOrCreate(
            [
                'name' => 'Marlo',
                'email' => 'marlosilva.f2@gmail.com',
                'password' => Hash::make('teste'),
            ]
        );

        $usuarios->push($usuario);

        $usuario = User::firstOrCreate(
            [
                'name' => 'Juliana',
                'email' => 'juli@gmail.com',
                'password' => Hash::make('teste'),
            ]
        );

        $usuarios->push($usuario);

        $papel = Papel::find(1);
        $permissao = Permissao::get();

        $usuarios->each(function ($usuario) use ($papel) {
            PapelUser::updateOrCreate([
                'user_id' => $usuario->id,
                'papel_id' => $papel->id
            ]);
        });

        $permissao->each(function ($permissao) use ($papel) {
            PapelPermissao::updateOrCreate([
                'permissao_id' => $permissao->id,
                'papel_id' => $papel->id
            ]);
        });
    }
}
