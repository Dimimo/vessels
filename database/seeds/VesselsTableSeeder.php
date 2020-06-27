<?php

use Illuminate\Database\Seeder;

/**
 * Class VesselsTableSeeder
 */
class VesselsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Vessel::class, 20)->create();
    }
}
