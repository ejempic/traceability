<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Stevebauman\Location\Facades\Location;

class BfarController extends Controller
{


    public function bfarIndex()
    {
        return view('admin.settings.bfar');
    }

    public function getUser()
    {
        $data = User::select('id', 'name', 'email')->where('category', 'bfar')->get();
        return response()->json($data);
    }

    public function storeUser(Request $request)
    {
        $role = 'BFAR';
        Role::updateOrCreate(
            ['name' => 'bfar'],
            [
                'name' => stringSlug($role),
                'display_name' => $role
            ]
        );

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt('agrabah');
        $user->passkey = 'agrabah';
        $user->active = 1;
        $user->category = 'bfar';
        if($user->save()) {
            $user->assignRole(stringSlug($role));
            $user->markEmailAsVerified();
        }
    }

    public function updateUser(Request $request)
    {

    }

    public function deleteUser(Request $request)
    {

    }
}
