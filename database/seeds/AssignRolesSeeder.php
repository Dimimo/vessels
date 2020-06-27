<?php

use App\Port;
use Illuminate\Database\Seeder;
use App\User;

/**
 * Class AssignRolesSeeder
 */
class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::whereIsSuperAdmin(true)->get()->each(function (User $u) {
            $u->hasRole('super admin') ? : $u->assignRole('super admin');
        });
        User::whereIsAdmin(true)->get()->each(function (User $u) {
            $u->hasRole('admin') ? : $u->assignRole('admin');
        });
        User::whereIsEditor(true)->get()->each(function (User $u) {
            $u->hasRole('editor') ? : $u->assignRole('editor');
        });
        User::whereIsStatistical(true)->get()->each(function (User $u) {
            $u->hasRole('statistical') ? : $u->assignRole('statistical');
        });
        User::whereIsPortAuthority(true)->get()->each(function (User $u) {
            $u->hasRole('port authority') ? : $u->assignRole('port authority');
            $ports = Port::all()->random(3);
            $u->ports()->sync($ports->pluck('id')->toArray());
        });
        User::whereIsOperator(true)->get()->each(function (User $u) {
            $u->hasRole('operator') ? : $u->assignRole('operator');
            $operators = Port::all()->random(3);
            $u->operators()->sync($operators->pluck('id')->toArray());
        });
        User::whereIsOperatorEmployee(true)->get()->each(function (User $u) {
            $u->hasRole('operator_employee') ? : $u->assignRole('operator_employee');
            $operators = Port::all()->random(3);
            $u->operators()->attach($operators->pluck('id')->toArray());
        });
        User::whereIsCaptain(true)->get()->each(function (User $u) {
            $u->hasRole('captain') ? : $u->assignRole('captain');
        });
        User::whereIsAgent(true)->get()->each(function (User $u) {
            $u->hasRole('captain') ? : $u->assignRole('agent');
            $ports = Port::all()->random(1);
            $u->ports()->sync($ports->pluck('id')->toArray());
        });
        App\Reservee::all()->each(function (App\Reservee $u) {
            $u->hasRole('reservee') ? : $u->assignRole('reservee');
        });
    }
}
