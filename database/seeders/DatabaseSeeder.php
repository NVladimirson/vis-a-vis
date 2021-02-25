<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create(
            [
            'id' => 1,
            'name' => 'Vis-a-vis',
            'email' => 'vis-a-vis@test.test',
            'password' => '$2y$10$wEnyglZ2x8NbEt23DVdfq.oxRByeF104pNi8VD6hPBCITPDyb3YmW',
            'created_at' => now(),
            'updated_at' => now()
            ]
        );
        // \App\Models\FirmModel::factory(100)->create();

        \App\Models\PhoneModel::factory(1000)->create();
    }
}
