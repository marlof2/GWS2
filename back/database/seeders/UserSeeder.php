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
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('teste'),
            ]
        );

        $usuarios->push($usuario);

        $usuarios->each(function ($usuario) {

            $papel = Papel::find(1);
            $permissao = Permissao::get();

            $papel->each(function ($papel) use ($usuario) {
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
        });
    }
}
