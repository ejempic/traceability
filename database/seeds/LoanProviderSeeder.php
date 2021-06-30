<?php

use Illuminate\Database\Seeder;
use App\LoanProvider;
use App\Profile;
use App\User;

class LoanProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = 5;
        for($a = 0; $a < $accounts; $a++){
            $faker = Faker\Factory::create();
            $number = str_pad(LoanProvider::count() + 1, 5, 0, STR_PAD_LEFT);
            $loanProvider = new LoanProvider();
            $loanProvider->account_id = $number;
            if($loanProvider->save()){
                $profile = new Profile();
                $profile->first_name = 'Bank of '.$faker->firstName;
                if($loanProvider->profile()->save($profile)){
                    $user = new User();
                    $user->name = ucwords($profile->first_name).' '.ucwords($profile->last_name);
                    $user->email = 'lp_'.($a+1).'@agrabah.com';
                    $user->password = bcrypt('agrabah');
                    $user->passkey = 'agrabah';
                    $user->active = 1;
                    if($user->save()) {
                        $user->assignRole(stringSlug('Loan Provider'));
                        $user->markEmailAsVerified();
                        $loanProvider->user_id = $user->id;
                        $loanProvider->save();
                    }
                }
            }
        }
    }
}
