<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $agent = Agent::create([
            'matricule' => '19esatic',
            'nom' =>'Amion',
            'prenom' =>'Davy',
            'tel' => '0767230749',
        ]);

        Role::create(['designation' => 'Admin']);
        Role::create(['designation' => 'Responsable']);
        Role::create(['designation' => 'Agent']);

        $user = User::create([
            'agent_id' => $agent->id,
            'role_id' => 1,
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin0000'),
        ]);

        event(new Registered($user));

    }
}
