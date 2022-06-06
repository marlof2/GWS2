<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Profile;
use App\Models\ProfileAction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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
                'profile_id' => 1,
                'name' => 'Marlo',
                'email' => 'marlosilva.f2@gmail.com',
                'password' => Hash::make('teste'),
            ]
        );

        $usuarios->push($usuario);

        $usuario = User::firstOrCreate(
            [
                'profile_id' => 2,
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('teste'),
            ]
        );

        $usuarios->push($usuario);

        $usuarios->each(function ($usuario) {

            $acoes = Action::get();

            $acoes->each(function ($acao) use ($usuario) {
                ProfileAction::updateOrCreate([
                    'profile_id' => $usuario->profile_id,
                    'action_id' => $acao->id
                ]);
            });
        });
    }
}
