<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Agent::create([
            'matricule' => '19esatic',
            'nom' =>'Amion',
            'prenom' =>'Davy',
            'tel' => '0767230749',
        ]);
    }
}
