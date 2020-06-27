<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() === 'local') {
            $this->call([
                ProvincesTableSeeder::class,
                CitiesTableSeeder::class,
                //BarangaysTableSeeder::class,
                UsersTableSeeder::class,
                PortsTableSeeder::class,
                OperatorsTableSeeder::class,
                CaptainsTableSeeder::class,
                VesselTypesTableSeeder::class,
                VesselsTableSeeder::class,
                DeparturesTableSeeder::class,
                TaxesTableSeeder::class,
                ReductionsTableSeeder::class,
                ReserveesTableSeeder::class,
                ReservationsTableSeeder::class,
                PassengersTableSeeder::class,
                PermissionsSeeder::class,
                AssignRolesSeeder::class,
            ]);
        } else {
            $this->call([
                ProvincesTableSeeder::class,
                CitiesTableSeeder::class,
                //BarangaysTableSeeder::class,
                PermissionsSeeder::class,
            ]);
        }
    }
}
