<?php

use Illuminate\Database\Seeder;

/**
 * Class OperatorsTableSeeder
 */
class OperatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Operator::class, 10)->create();
    }
}
