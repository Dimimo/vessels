<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Class PermissionsSeeder
 */
class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
// Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
// create permissions
        //super admin
        Permission::create(['name' => 'make admin']);
        //view information for officials only
        Permission::create(['name' => 'official info']);
        //users
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit own users']);
        Permission::create(['name' => 'edit all users']);
        Permission::create(['name' => 'delete own users']);
        Permission::create(['name' => 'delete all users']);
        //articles
        Permission::create(['name' => 'create articles']);
        Permission::create(['name' => 'edit own articles']);
        Permission::create(['name' => 'edit all articles']);
        Permission::create(['name' => 'delete own articles']);
        Permission::create(['name' => 'delete all articles']);
        //publishing articles
        Permission::create(['name' => 'publish own articles']);
        Permission::create(['name' => 'publish all articles']);
        Permission::create(['name' => 'unpublish own articles']);
        Permission::create(['name' => 'unpublish all articles']);
        //ports
        Permission::create(['name' => 'create ports']);
        Permission::create(['name' => 'edit own ports']);
        Permission::create(['name' => 'edit all ports']);
        Permission::create(['name' => 'delete own ports']);
        Permission::create(['name' => 'delete all ports']);
        //operators
        Permission::create(['name' => 'create operators']);
        Permission::create(['name' => 'edit own operators']);
        Permission::create(['name' => 'edit all operators']);
        Permission::create(['name' => 'delete own operators']);
        Permission::create(['name' => 'delete all operators']);
        //vessels
        Permission::create(['name' => 'create vessels']);
        Permission::create(['name' => 'edit own vessels']);
        Permission::create(['name' => 'edit all vessels']);
        Permission::create(['name' => 'delete own vessels']);
        Permission::create(['name' => 'delete all vessels']);
        //captains
        Permission::create(['name' => 'create captains']);
        Permission::create(['name' => 'edit own captains']);
        Permission::create(['name' => 'edit all captains']);
        Permission::create(['name' => 'delete own captains']);
        Permission::create(['name' => 'delete all captains']);
        //agents
        Permission::create(['name' => 'create agents']);
        Permission::create(['name' => 'edit own agents']);
        Permission::create(['name' => 'edit all agents']);
        Permission::create(['name' => 'delete own agents']);
        Permission::create(['name' => 'delete all agents']);
        //departures
        Permission::create(['name' => 'create departures']);
        Permission::create(['name' => 'edit own departures']);
        Permission::create(['name' => 'edit all departures']);
        Permission::create(['name' => 'delete own departures']);
        Permission::create(['name' => 'delete all departures']);
        //real departure + passengers input by captains
        Permission::create(['name' => 'real own departures']);
        Permission::create(['name' => 'real all departures']);
// create roles and assign existing permissions
        $super_admin = Role::create(['name' => 'super admin']);
        $super_admin->givePermissionTo([
            'make admin',
            'official info',
            'create users',
            'edit all users',
            'delete all users',
            'create ports',
            'edit all ports',
            'delete all ports',
            'create articles',
            'edit all articles',
            'delete all articles',
            'publish all articles',
            'unpublish all articles',
            'create operators',
            'edit all operators',
            'delete all operators',
            'create operators',
            'edit all operators',
            'delete all operators',
            'create vessels',
            'edit all vessels',
            'delete all vessels',
            'create agents',
            'edit all agents',
            'delete all agents',
            'create captains',
            'edit all captains',
            'delete all captains',
            'create departures',
            'edit all departures',
            'delete all departures',
            'real all departures',
        ]);
        $admins = Role::create(['name' => 'admin']);
        $admins->givePermissionTo([
            'official info',
            'create users',
            'edit all users',
            'delete all users',
            'create ports',
            'edit all ports',
            'delete all ports',
            'create articles',
            'edit all articles',
            'delete all articles',
            'publish all articles',
            'unpublish all articles',
            'create operators',
            'edit all operators',
            'delete all operators',
            'create vessels',
            'edit all vessels',
            'delete all vessels',
            'create agents',
            'edit all agents',
            'delete all agents',
            'create captains',
            'edit all captains',
            'delete all captains',
            'create departures',
            'edit all departures',
            'delete all departures',
        ]);
        $moderators = Role::create(['name' => 'moderator']);
        $moderators->givePermissionTo([
            'official info',
            'create articles',
            'edit all articles',
            'delete all articles',
            'publish all articles',
            'unpublish all articles',
        ]);
        $port_authority = Role::create(['name' => 'port authority']);
        $port_authority->givePermissionTo([
            'official info',
            'create users',
            'edit own users',
            'delete own users',
            'edit own ports',
            'create articles',
            'edit own articles',
            'delete own articles',
            'publish own articles',
            'unpublish own articles',
            'create operators',
            'edit own operators',
            'delete own operators',
            'create agents',
            'edit own agents',
            'delete own agents',
            'edit own vessels',
            'edit own captains',
            'edit own departures',
            'real own departures',
        ]);
        $operators = Role::create(['name' => 'operator']);
        $operators->givePermissionTo([
            'official info',
            'create users',
            'edit own users',
            'delete own users',
            'edit own operators',
            'create vessels',
            'edit own vessels',
            'delete own vessels',
            'create captains',
            'edit own captains',
            'delete own captains',
            'create departures',
            'edit own departures',
            'delete own departures',
            'real own departures'
        ]);
        $agents = Role::create(['name' => 'agents']);
        $agents->givePermissionTo([
            'official info',
            'create departures',
            'edit own departures',
            'delete own departures',
            'real own departures',
        ]);
        $captains = Role::create(['name' => 'captain']);
        $captains->givePermissionTo('real own departures');
    }
}
