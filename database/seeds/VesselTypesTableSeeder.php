<?php

use Illuminate\Database\Seeder;

/**
 * Class VesselTypesTableSeeder
 */
class VesselTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\VesselType::class, 4)->create();
    }
}
