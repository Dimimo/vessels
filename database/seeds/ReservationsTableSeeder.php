<?php

use Illuminate\Database\Seeder;

/**
 * Class ReservationsTableSeeder
 */
class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Reservation::class, 20)->create();
    }
}
