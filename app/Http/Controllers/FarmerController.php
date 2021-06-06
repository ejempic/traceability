<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Inventory;
use App\MasterFarmer;
use App\Product;
use App\Profile;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('super-admin')){
            $datas = Farmer::with(array('master', 'profile'))->get();
        }else{
            $datas = Farmer::with(array('master', 'profile'))
                ->where('master_id', Auth::user()->master->id)
                ->get();
        }

//        return $datas;
        return response()->view('user.farmer.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = MasterFarmer::with('profile')->get();
        return response()->view('user.farmer.create', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = new Profile();
        $profile->first_name = $request->input('first_name');
        $profile->middle_name = $request->input('middle_name');
        $profile->last_name = $request->input('last_name');
        $profile->mobile = $request->input('mobile');
        $profile->address = $request->input('address');
        $profile->education = $request->input('education');

        $profile->four_ps = $request->input('four_ps', 0);
        $profile->pwd = $request->input('pwd', 0);
        $profile->indigenous = $request->input('indigenous', 0);
        $profile->livelihood = $request->input('livelihood', 0);

        $profile->farm_lot = $request->input('farm_lot');
        $profile->farming_since = $request->input('farming_since');
        $profile->organization = $request->input('organization');
        if($profile->save()){
            $farmer = new Farmer();
            $farmer->master_id = Auth::user()->master->id;
            $farmer->profile_id = $profile->id;
            if($farmer->save()){
                return redirect()->route('farmer.index');
            }
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function show(Farmer $farmer)
    {
        $data = Farmer::with('profile', 'inventory')->find($farmer->id);
//        return $data;
        $group = array();
        if($data->profile->four_ps == 1){
            array_push($group,'4Ps');
        }
        if($data->profile->pwd == 1){
            array_push($group,'PWD');
        }
        if($data->profile->indigenous == 1){
            array_push($group,'Indigenous');
        }
        if($data->profile->livelihood == 1){
            array_push($group,'Livelihood');
        }

        $inventories = Inventory::where('farmer_id', $farmer->id)->get();

//        return $group;
        return view('user.farmer.show', compact('data', 'group', 'inventories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmer $farmer)
    {
        return view('user.farmer.edit', compact('farmer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farmer $farmer)
    {
        $farmer = Farmer::find($farmer->id);

        $profile = Profile::find($farmer->profile_id);
        $profile->first_name = $request->input('first_name');
        $profile->middle_name = $request->input('middle_name');
        $profile->last_name = $request->input('last_name');
        $profile->mobile = $request->input('mobile');
        $profile->address = $request->input('address');
        $profile->education = $request->input('education');

        $profile->four_ps = $request->input('four_ps', 0);
        $profile->pwd = $request->input('pwd', 0);
        $profile->indigenous = $request->input('indigenous', 0);
        $profile->livelihood = $request->input('livelihood', 0);

        $profile->farm_lot = $request->input('farm_lot');
        $profile->farming_since = $request->input('farming_since');
        $profile->organization = $request->input('organization');
        if($profile->save()){
            return redirect()->route('farmer.show', array('farmer'=>$farmer->id));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farmer $farmer)
    {
        //
    }
}
