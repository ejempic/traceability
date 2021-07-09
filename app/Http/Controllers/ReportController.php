<?php

namespace App\Http\Controllers;

use App\Trace;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function traceReport(Request $request)
    {
        $input = $request->input('length');
        $lengthData = null;
        $totalData = null;
        $successData = null;
        $failedData = null;
        $date2Data = null;

        $now = Carbon::now();
        switch ($input) {
            case 'weekly':
                $dates = [];
                $date2 = [];
                $total = [];
                $success = [];
                $failed = [];
                $length = $now->endOfWeek()->diffInDays($now->copy()->startOfWeek());

                $date = $now->startOfWeek();
                for ($i = 0; $i < $length; $i++) {
                    if($i == 0){
                        $dates[] = $date->copy()->format('D jS');

//                        $date2[] = Trace::count()->groupBy(function($date) {
//                            return Carbon::parse($date->create)->format('Y-m-d');
//                        });

//                        $date2[] = $date->copy()->toDateString();
                        $total[] = Trace::where('created_at', $date->copy()->toDateString())
                            ->count();
                        $success[] = Trace::where('created_at', $date->copy()->toDateString())
                            ->where('delivered', 1)
                            ->count();
                        $failed[] = Trace::where('created_at', $date->copy()->toDateString())
                            ->where('delivered', 0)
                            ->count();
                    }else{
                        $dates[] = $date->copy()->addDay()->format('D jS');

                        $date2[] = Trace::get()->groupBy(function($date) {
                            return Carbon::parse($date->create)->format('Y-m-d');
                        });

                        $total[] = Trace::where('created_at', $date->copy()->addDays()->toDateString())
                            ->count();
                        $success[] = Trace::where('created_at', $date->copy()->addDays()->toDateString())
                            ->where('delivered', 1)
                            ->count();
                        $failed[] = Trace::where('created_at', $date->copy()->addDays()->toDateString())
                            ->where('delivered', 0)
                            ->count();
                    }
                }

//                $weekly = Trace::get()->groupBy(function($date) {
//                    return Carbon::parse($date->create)->format('W');
//                });
//                return $weekly;

//                $trace = Trace::get();

                $lengthData = $dates;
                $totalData = $total;
                $successData = $success;
                $failedData = $failed;
                $date2Data = $date2;
                break;
            case 'monthly':
                $dates = [];
                $length = $now->endOfMonth()->diffInDays($now->copy()->startOfMonth());

                $date = $now->startOfMonth();
                for ($i = 0; $i < $length; $i++) {
                    if($i == 0){
                        $dates[] = $date->format('d');
                    }else{
                        $dates[] = $date->addDays()->format('d');
                    }
                }
                $lengthData = $dates;
                break;
            case 'annual':
                $lengthData = array(
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December'
                );
                break;
        }

        return response()->json(array($lengthData, $totalData, $successData, $failedData));
    }
}
