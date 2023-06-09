<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'super admin',
            'email' => 'super-admin@admin.com',
            'password' => '$2y$10$aVqzDjA2bXysxgozlNsUV.yxEhPf2uIpnqL1un4wl6myWWHPl6poy' // Abde2101
        ])->assignRole('super admin');
    }
}
