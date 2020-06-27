<?php

use Illuminate\Database\Seeder;

/**
 * Class ReductionsTableSeeder
 */
class ReductionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Reduction::class, 10)->create();
    }
}
