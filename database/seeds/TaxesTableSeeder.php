<?php

use Illuminate\Database\Seeder;

/**
 * Class TaxesTableSeeder
 */
class TaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tax::class, 10)->create();
    }
}
