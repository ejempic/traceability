<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\LoanProvider;
use App\Profile;
use App\Settings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.database.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function truncate(Request  $request)
    {
        $tables = $request->input('databases');

        if(in_array('loans', $tables)){
            DB::table('loan_application_details')->truncate();
            DB::table('loan_borrowers')->truncate();
            DB::table('loan_disbursements')->truncate();
            DB::table('loan_payment_schedules')->truncate();
            DB::table('loan_payments')->truncate();
            DB::table('loans')->truncate();
            DB::table('loan_providers')->truncate();
            DB::table('loan_products')->truncate();
        }
        if(in_array('trace', $tables)){
            DB::table('traces')->truncate();
        }
        if(in_array('wharf', $tables)){
            DB::table('spot_market_bids')->truncate();
            DB::table('spot_markets')->truncate();
            DB::table('reverse_bidding_bids')->truncate();
            DB::table('reverse_biddings')->truncate();
        }
        if(in_array('users_except_superadmin', $tables)){
            $users = User::where('email','!=','superadmin@agrabah.ph')->delete();
            Farmer::truncate();
            LoanProvider::truncate();
        }
        return redirect()->back()->with('success','Tables Truncated!');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $settingsOld = [];
        if ($request->has('settings')){

            $settings = $request->settings;

            foreach($settings['id'] as $id => $value){
                $checked = 0;
                if(array_key_exists('is_active', $settings)){
                    if(array_key_exists($id, $settings['is_active'])){
                        $checked = 1;
                    }
                }else{
                    $checked = 0;
                }

                $settingsOld[$id] =$checked;
                Settings::where('id', $id)->update([
                    'value' => $value,
                    'is_active' => $checked,
                ]);
            }
        }
        if ($request->has('new_entry')){
            $newEntry = $request->new_entry;
            foreach($newEntry['name'] as $index => $name){
                $checked = 0;
                if(array_key_exists('is_active', $newEntry)){
                    if(array_key_exists($index, $newEntry['is_active'])){
                        $checked = 1;
                    }
                }else{
                    $checked = 0;
                }
                Settings::create([
                    'name' => stringSlug($name),
                    'display_name' => $name,
                    'value' => $newEntry['value'][$index],
                    'is_active' => $checked,
                ]);
            }

        }
        DB::commit();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
