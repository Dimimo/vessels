<?php

use Illuminate\Database\Seeder;

/**
 * Class PassengersTableSeeder
 */
class PassengersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Passenger::class, 60)->create();
    }
}
