<?php

use Illuminate\Database\Seeder;

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
