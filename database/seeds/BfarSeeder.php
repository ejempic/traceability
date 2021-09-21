<?php

use App\Settings;
use Illuminate\Database\Seeder;

class BfarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Settings();
        $setting->name = stringSlug('BFAR');
        $setting->display_name = 'BFAR';
        $setting->save();
    }
}
