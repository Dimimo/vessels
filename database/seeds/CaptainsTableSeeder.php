<?php

use Illuminate\Database\Seeder;

/**
 * Class CaptainsTableSeeder
 */
class CaptainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Captain::class, 10)->create();
    }
}
