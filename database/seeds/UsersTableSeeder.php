<?php

use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'name'              => 'Administrator',
                'slug'              => 'administrator',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt('12345678'),
                'is_super_admin'    => '1',
                'email_verified_at' => Carbon\Carbon::now(),
                'created_at'        => Carbon\Carbon::now(),
                'updated_at'        => Carbon\Carbon::now()]
        );

        if (App::environment() === 'local') {
            factory(App\User::class, 20)->create();

            App\User::find(2)->update(['is_admin' => true]);
            App\User::find(3)->update(['is_statistical' => true]);
            App\User::find(4)->update(['is_editor' => true]);
            App\User::whereIn('id', [5, 6, 7, 8, 9, 10])->get()->each(function (App\User $u) {
                $u->update(['is_port_authority' => true]);
            });
            App\User::whereIn('id', [11, 12, 13, 14, 15, 16])->get()->each(function (App\User $u) {
                $u->update(['is_operator' => true]);
            });
            App\User::whereIn('id', [17, 18])->get()->each(function (App\User $u) {
                $u->update(['is_operator_employee' => true]);
            });
            App\User::whereIn('id', [19, 20])->get()->each(function (App\User $u) {
                $u->update(['is_agent' => true]);
            });
        }
    }
}
