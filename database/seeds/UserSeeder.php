<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Profile;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = array(
            array('User', array(
                'Browse',
                'Read',
                'Edit',
                'Add',
                'Delete'
            )),
            array('Profile', array(
                'Browse',
                'Read',
                'Edit',
                'Add',
                'Delete'
            )),
            array('Inventory', array(
                'Browse',
                'Read',
                'Edit',
                'Add',
                'Delete'
            )),
            array('Setting', array(
                'Browse',
                'Read',
                'Edit',
                'Add',
                'Delete'
            ))
        );

        foreach ($models as $model) {
            foreach ($model[1] as $permission){
                Permission::create([
                    'name' => stringSlug($permission).'-'.stringSlug($model[0]),
                    'display_name' => $permission, 'table_name' => stringSlug($model[0]),
                    'table_display_name' => $model[0]
                ]);
            }
        }

        $roles = array(
            'Super Admin',
            'Master Farmer',
            'Farmer'
        );

        foreach($roles as $role) {
            Role::create(array(
                'name' => stringSlug($role),
                'display_name' => $role
            ));
        }

        $user = new User();
        $user->name = 'Agravah Admin';
        $user->email = 'agravah@gmail.com';
        $user->password = bcrypt('grassfruitrabbitengine');
        $user->passkey = 'grassfruitrabbitengine';
        $user->active = 1;
        if($user->save()) {

            $user->assignRole(stringSlug('Super Admin'));
            $user->markEmailAsVerified();

        }

    }
}
