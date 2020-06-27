<?php

use Illuminate\Database\Seeder;

/**
 * Class PortsTableSeeder
 */
class PortsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Port::class, 10)->create();
    }
}
