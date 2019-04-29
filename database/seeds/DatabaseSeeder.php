<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            PortsTableSeeder::class,
            //OperatorsTableSeeder::class,
            //VesselsTableSeeder::class,
            //CaptainsTableSeeder::class,
            DeparturesTableSeeder::class,
            PermissionsSeeder::class,
        ]);

        //seed the pivot tables
        $ports = \App\Port::all();
        // Populate the pivot table
        \App\User::where('id', '<', '21')->each(function ($user) use ($ports) {
            $user->ports()->attach(
                $ports->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $operators = \App\Operator::all();
        \App\User::where('id', '<', '21')->each(function ($user) use ($operators) {
            $user->operators()->attach(
                $operators->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
