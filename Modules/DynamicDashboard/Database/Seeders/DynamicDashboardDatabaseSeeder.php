<?php

namespace Modules\DynamicDashboard\Database\Seeders;

use Illuminate\Database\Seeder;

class DynamicDashboardDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([WidgetsTableSeeder::class]);
        $this->call([TemplatesTableSeeder::class]);
    }
}
