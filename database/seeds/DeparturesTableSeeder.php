<?php

use Illuminate\Database\Seeder;

/**
 * Class DeparturesTableSeeder
 */
class DeparturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Departure::class, 20)->create();
    }
}
