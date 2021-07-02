<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $accounts = 100;
        for($a = 0; $a < $accounts; $a++) {
            $provider = \App\LoanProvider::count();
            $type = \App\LoanType::count();
            $loan = new \App\Loan();
            $loan->loan_provider_id = rand(1,$provider);
            $loan->loan_type = rand(1,$type);
            $loan->name = $faker->word(1);
            $loan->description = $faker->word(rand(1,20));
            $loan->amount = rand(1,9) * 10000;
            $loan->duration = rand(5,30);
            $loan->interest_rate = rand(1,100);
            $loan->save();
        }
    }
}
