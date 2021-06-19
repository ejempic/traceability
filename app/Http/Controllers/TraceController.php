<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Inventory;
use App\Mail\TraceShipped;
use App\Trace;
use App\ModelInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
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
        $trace = Trace::with('inventories')->find($trace->id);
//        $inventory = Inventory::with('farmer')->where('trace_id', $trace->id)->get();
//        return $trace;
        return view('user.trace.show', compact('trace'));
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
        $trace->reference = $data[8];
        $trace->url = route('trace-info', array('code'=>$data[8]));
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

            $code = Str::random(15);
            $url = route('trace-shipped', array('code'=>$code));
            QrCode::size(500)
                ->format('png')
                ->generate($url, public_path('images/trace/'.$code.'.png'));

            $modelInfo = new ModelInfo();
            $modelInfo->type = 'receiver';
            $modelInfo->value_0 = $data[0]; // name
            $modelInfo->value_1 = $data[1]; // email
            $modelInfo->value_2 = $data[2]; // mobile
            $modelInfo->value_3 = $code.'.png';
            $modelInfo->value_4 = '/images/trace/'.$code.'.png';
            $modelInfo->text_0 = $data[3]; // address
            $modelInfo->text_1 = base64_encode(file_get_contents(public_path('images/trace/'.$code.'.png'))); // address
            if($trace->info()->save($modelInfo)){

                $myEmail = $data[1];

                $details = [
                    'title' => 'Agrabah Shipping details.',
                    'url' => route('trace-tracking', array('code'=>$trace->reference)),
                    'body' => 'Please present this QR CODE upon receiving your package.',
                    'reference' => $modelInfo->text_1,
                    'qrcode' => $modelInfo->text_1,
                ];

                Mail::to($myEmail)->send(new TraceShipped($details));
            }

            $modelInfo = new ModelInfo();
            $modelInfo->type = 'dispatch';
            $modelInfo->value_0 = $data[4];
            $modelInfo->value_1 = $data[5];
            $modelInfo->value_2 = $data[6];
            $modelInfo->value_3 = $data[7];
            $trace->info()->save($modelInfo);

            foreach($data[10] as $id){
                $inventory = Inventory::find($id);
                $inventory->status = 'Loaded';
                $inventory->trace_id = $trace->id;
                $inventory->save();
            }

            $url = route('trace.show', array('trace'=>$trace));
            return response()->json($url);
        }
    }

    public function traceInfo($code)
    {
        $data = Trace::where('reference', $code)->first();
//        return $data;
        return view('user.mobile.trace-info', compact('data'));
    }

    public function traceUpdate(Request $request)
    {
        $action = $request->input('action');
        $update = '';
        $trace = Trace::find($request->input('id'));
        $modelInfo = new ModelInfo();
        $modelInfo->type = 'status';
        switch ($action){
            case 'Depart':
                $update = 'Transit';
                $modelInfo->value_0 = $update;
                $modelInfo->value_1 = 'On Transit';
                break;
            case 'Transit':
                $update = 'Arrive';
                $modelInfo->value_0 = $update;
                $modelInfo->value_1 = 'Arrived at destination';
                break;
            case 'Arrive':
                $update = 'Loaded';
                $modelInfo->value_0 = $update;
                $modelInfo->value_1 = 'Waiting to travel';
                break;
            case 'Delivered':
                $update = $action;
                $modelInfo->value_0 = $action;
                $modelInfo->value_1 = 'Delivered to Client';
                break;
            case 'Undeliverable':
                $update = $action;
                $modelInfo->value_0 = $action;
                $modelInfo->value_1 = 'Undeliverable';
                break;
        }
        $trace->info()->save($modelInfo);

        Trace::find($trace->id)->inventories()->update(array(
            'status'=>$update
        ));

//        return response()->json();
    }

    public function traceQrPrint($reference)
    {
        $data = Trace::where('reference', $reference)->first();

        return view('user.mobile.trace-qr-print', compact('data'));
    }
}
