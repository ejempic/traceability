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
//        $sampleData = null;

        $now = Carbon::now();
        switch ($input) {
            case 'weekly':
                $dates = [];
                $total = [];
                $success = [];
                $failed = [];
//                $sample = [];
                $length = $now->endOfWeek()->diffInDays($now->copy()->startOfWeek());

                $date = $now->startOfWeek();

//                $sample[] = $date->copy()->addDays(4)->startOfDay()->toDateTimeString();
//                $sample[] = $date->copy()->addDays(4)->endOfDay()->toDateTimeString();
//                $sample[] = Trace::whereBetween('created_at', [
//                            $date->copy()->addDays(4)->startOfDay()->toDateTimeString(),
//                            $date->copy()->addDays(4)->endOfDay()->toDateTimeString()
//                        ])->count();

                for ($i = 0; $i < $length; $i++) {
                    $dates[] = $date->copy()->addDays($i)->format('D jS');
                    $total[] = Trace::whereBetween('created_at', [
                            $date->copy()->addDays($i)->startOfDay()->toDateTimeString(),
                            $date->copy()->addDays($i)->endOfDay()->toDateTimeString()
                        ])
                        ->count();
                    $success[] = Trace::where('delivered', 1)
                        ->where('active', 0)
                        ->whereBetween('created_at', [
                            $date->copy()->addDays($i)->startOfDay()->toDateTimeString(),
                            $date->copy()->addDays($i)->endOfDay()->toDateTimeString()
                        ])
                        ->count();
                    $failed[] = Trace::where('delivered', 0)
                        ->where('active', 0)
                        ->whereBetween('created_at', [
                            $date->copy()->addDays($i)->startOfDay()->toDateTimeString(),
                            $date->copy()->addDays($i)->endOfDay()->toDateTimeString()
                        ])
                        ->count();
                }

                $lengthData = $dates;
                $totalData = $total;
                $successData = $success;
                $failedData = $failed;
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
