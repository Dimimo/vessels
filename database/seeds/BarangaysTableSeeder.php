<?php

use Illuminate\Database\Seeder;

/**
 * Class BarangaysTableSeeder
 */
class BarangaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Barangays1TableSeeder::class,
            Barangays2TableSeeder::class,
            Barangays3TableSeeder::class,
            Barangays4TableSeeder::class,
            Barangays5TableSeeder::class,
            Barangays6TableSeeder::class,
            Barangays7TableSeeder::class,
            Barangays8TableSeeder::class,
            Barangays9TableSeeder::class,
            Barangays10TableSeeder::class,
            Barangays11TableSeeder::class,
            Barangays12TableSeeder::class,
            Barangays13TableSeeder::class,
            Barangays14TableSeeder::class,
        ]);
    }
}