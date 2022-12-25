<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'mersmith14@gmail.com',
            'password' => bcrypt('123456789'),
            'rol' => 'administrador',
        ])->{Administrador::factory(1)->create([
            'user_id' => 1,
            'correo' => 'mersmith14@gmail.com',
        ])};

        //Administradores
        User::factory(5)->create([
            'rol' => 'administrador',
        ])->each(function (User $usuario) {
            Administrador::factory(1)->create([
                'user_id' => $usuario->id,
                'correo' => $usuario->email,
            ]);
        });
    }
}
