<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Inventory;
use App\Trace;
use App\ModelInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TraceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('super-admin')){
            $datas = Trace::get();
        }else{
            $datas = Trace::where('user_id', Auth::user()->id)->get();
        }
//        return $datas;
        return response()->view('user.trace.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $datas = Inventory::where('status', 'Accepted')->get();
//            return $datas;
        $random = Str::random(15);

//        $host_names = explode(".", $_SERVER['HTTP_HOST']);
//        $url = $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1]."/".$random;

        $url = route('trace-info', array('code'=>$random));
        return response()->view('user.trace.create', compact('datas', 'random', 'url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trace  $trace
     * @return \Illuminate\Http\Response
     */
    public function show(Trace $trace)
    {
        $trace = Trace::find($trace->id);
        $inventory = Inventory::with('farmer')->where('trace_id', $trace->id)->get();
//        return $trace;
        return view('user.trace.show', compact('trace', 'inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trace  $trace
     * @return \Illuminate\Http\Response
     */
    public function edit(Trace $trace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trace  $trace
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trace $trace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trace  $trace
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trace $trace)
    {
        //
    }

    public function farmerInventoryList()
    {
        $data = Inventory::where('master_id', Auth::user()->id)
            ->where('status', 'Accepted')
            ->get();

        return response()->json($data);
    }

    public function traceStore(Request $request)
    {
        $data = $request->input('datas');
        $trace = new Trace();
        $trace->reference = $data[7];
        $trace->url = route('trace-info', array('code'=>$data[7]));
        $trace->user_id = Auth::user()->id;
        if($trace->save()){
            QrCode::size(500)
                ->format('png')
                ->generate($trace->url, public_path('images/trace/'.$trace->reference.'.png'));
            $trace->image = $trace->reference.'.png';
            $trace->image_path = '/images/trace/'.$trace->reference.'.png';
            $trace->save();

            $modelInfo = new ModelInfo();
            $modelInfo->type = 'status';
            $modelInfo->value_0 = 'Loaded';
            $modelInfo->value_1 = 'Waiting to travel';
            $trace->info()->save($modelInfo);

            $modelInfo = new ModelInfo();
            $modelInfo->type = 'receiver';
            $modelInfo->value_0 = $data[0];
            $modelInfo->value_1 = $data[1];
            $modelInfo->text_0 = $data[2];
            $trace->info()->save($modelInfo);

            $modelInfo = new ModelInfo();
            $modelInfo->type = 'dispatch';
            $modelInfo->value_0 = $data[3];
            $modelInfo->value_1 = $data[4];
            $modelInfo->value_2 = $data[5];
            $modelInfo->value_3 = $data[6];
            $trace->info()->save($modelInfo);

            foreach($data[9] as $id){
                $inventory = Inventory::find($id);
                $inventory->status = 'Loaded';
                $inventory->trace_id = $trace->id;
                $inventory->save();
            }
        }
    }

    public function traceInfo($code)
    {
        $data = Trace::where('reference', $code)->first();
//        return $data;
        return view('trace-info', compact('data'));
    }

    public function traceUpdate(Request $request)
    {
        $action = $request->input('action');
        $trace = Trace::find($request->input('id'));
        $modelInfo = new ModelInfo();
        $modelInfo->type = 'status';
        switch ($action){
            case 'Depart':
                $modelInfo->value_0 = 'Transit';
                $modelInfo->value_1 = 'On Transit';
                break;
            case 'Transit':
                $modelInfo->value_0 = 'Arrive';
                $modelInfo->value_1 = 'Arrived at destination';
                break;
            case 'Arrive':
                $modelInfo->value_0 = 'Loaded';
                $modelInfo->value_1 = 'Waiting to travel';
                break;
            case 'Delivered':
                $modelInfo->value_0 = $action;
                $modelInfo->value_1 = 'Delivered to Client';
                break;
            case 'Undeliverable':
                $modelInfo->value_0 = $action;
                $modelInfo->value_1 = 'Undeliverable';
                break;
        }

        $trace->info()->save($modelInfo);
    }
}
