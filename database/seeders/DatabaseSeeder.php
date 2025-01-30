<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WorkOrder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrador',
            'idt' => '031.778.097-1',
            'password' => bcrypt('0317780971'),
        ]);

        WorkOrder::factory(10)->create();

    }
}
