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
        $sampleData = null;

        $now = Carbon::now();
        switch ($input) {
            case 'weekly':
                $dates = [];
                $total = [];
                $success = [];
                $failed = [];
                $length = $now->endOfWeek()->diffInDays($now->copy()->startOfWeek());

                $date = $now->startOfWeek();

//                $sample = Trace::whereIn('created_at', array(
//                    $date->copy()->addDays(5)->startOfDay(),
//                    $date->copy()->addDays(5)->endOfDay()
//                ))->count();

                for ($i = 0; $i < $length; $i++) {
                    $dates[] = $date->copy()->addDays($i)->format('D jS');
                    $total[] = Trace::where('created_at', $date->copy()->addDays($i)->toDateString())
                        ->count();
                    $success[] = Trace::where('created_at', $date->copy()->addDays($i)->toDateString())
                        ->where('delivered', 1)
                        ->count();
                    $failed[] = Trace::where('created_at', $date->copy()->addDays($i)->toDateString())
                        ->where('delivered', 0)
                        ->count();
                }

                $lengthData = $dates;
                $totalData = $total;
                $successData = $success;
                $failedData = $failed;
                $sampleData = $sample;
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

        return response()->json(array($lengthData, $totalData, $successData, $failedData, $sampleData));
    }
}
