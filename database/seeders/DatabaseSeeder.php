<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Administrador',
        //     'email' => 'admin@admin.com',
        //     'idt' => '031.778.097-1',
        //     'password' => bcrypt('0317780971'),
        // ]);

        User::factory()->create([
            'name' => 'Usuário',
            'email' => '1234@admin.com',
            'idt' => '031.778.097-0',
            'password' => bcrypt('0317780970'),
        ]);
    }
}
