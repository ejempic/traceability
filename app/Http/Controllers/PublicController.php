<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Trace;
use App\ModelInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function traceTracking($code)
    {
        $trace = Trace::where('reference', $code)->first();
//        return $trace;
        return view('user.mobile.trace-tracking', compact('trace'));
    }

    public function traceShipped($code)
    {
        $trace = Trace::where('reference', $code)->first();
        $modelInfo = new ModelInfo();
        $modelInfo->type = 'status';
        $modelInfo->value_0 = 'Delivered';
        $modelInfo->value_1 = 'Delivered to Client';
        $trace->info()->save($modelInfo);

        return redirect()->route('trace-tracking', array('code'=>$trace->reference));
    }
}
