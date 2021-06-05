<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Inventory;
use App\ModelInfo;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Inventory::with('product')->get();
//        return $datas;
        return view('user.inventory.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Farmer::with('profile')
            ->where('master_id', Auth::user()->master->id)
            ->get();
//        return $datas;
        return response()->view('user.inventory.create', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Inventory();
        $data->master_id = Auth::user()->master->id;
        $data->farmer_id = $request->input('farmer_id');
        $data->name = $request->input('name');
        $data->details = $request->input('details');
        $data->status = 'Accepted';
        $data->remark = 'Warehouse';
        $data->user_id = Auth::user()->master->id;
        if($data->save()){

            $modelInfo = new ModelInfo();
            $modelInfo->type = 'status';
            $modelInfo->value_0 = $data->status;
            $modelInfo->value_1 = $data->remark;
            $data->info()->save($modelInfo);

            return redirect()->route('inventory.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }

    public function farmerInventoryList(Request $request)
    {
//        $ids = array();
        $data = Inventory::whereNotIn('id', $request->input('ids'))
            ->where('master_id', Auth::user()->master->id)
            ->with('farmer')
            ->where('status', 'Accepted')
            ->get();

        return response()->json($data);
    }

    public function farmerInventoryListItem(Request $request)
    {
        $data = Inventory::whereIn('id', $request->input('ids'))
            ->with('farmer')
            ->get();

        return response()->json($data);
    }
}
