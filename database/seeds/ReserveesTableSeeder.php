<?php

use Illuminate\Database\Seeder;

/**
 * Class ReserveesTableSeeder
 */
class ReserveesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Reservee::class, 20)->create();
    }
}
