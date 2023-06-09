<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@sdmm.com',
            'password' => Hash::make('7Even&0Ne') // 7Even&0Ne
        ])->assignRole('admin');

        User::create([
            'name' => 'sous directeur',
            'email' => 'directeur@sdmm.com',
            'password' => Hash::make('directeur@sdmm.com')
        ])->assignRole('directeur');

        User::create([
            'name' => 'chef magasinier',
            'email' => 'chef@sdmm.com',
            'password' => Hash::make('chef@sdmm.com')
        ])->assignRole('chef');

        User::create([
            'name' => 'magasinier',
            'email' => 'magasinier@sdmm.com',
            'password' => Hash::make('magasinier@sdmm.com')
        ])->assignRole('magasinier');
    }
}

// 7Even&0Ne
//$2y$10$tXJziHLmdTaBX.DWzVUhsO4apjNIALfg/QcAwZ8uiS6ZeERf7n27e