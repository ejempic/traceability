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
                $length = $now->endOfWeek()->diffInDays($now->copy()->startOfWeek()) +1;
                $date = $now->startOfWeek();

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
                $length = $now->endOfMonth()->diffInDays($now->copy()->startOfMonth()) +1;
                $date = $now->startOfMonth();

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
            case 'annual':
                $dates = [];
                $length = $now->endOfYear()->diffInMonths($now->copy()->startOfYear()) +1;
                $date = $now->startOfYear();

                for ($i = 0; $i < $length; $i++) {
                    $dates[] = $date->copy()->addMonths($i)->format('F');
                    $total[] = Trace::whereBetween('created_at', [
                        $date->copy()->addMonths($i)->startOfMonth()->toDateTimeString(),
                        $date->copy()->addMonths($i)->endOfMonth()->toDateTimeString()
                    ])
                        ->count();
                    $success[] = Trace::where('delivered', 1)
                        ->where('active', 0)
                        ->whereBetween('created_at', [
                            $date->copy()->addMonths($i)->startOfMonth()->toDateTimeString(),
                            $date->copy()->addMonths($i)->endOfMonth()->toDateTimeString()
                        ])
                        ->count();
                    $failed[] = Trace::where('delivered', 0)
                        ->where('active', 0)
                        ->whereBetween('created_at', [
                            $date->copy()->addMonths($i)->startOfMonth()->toDateTimeString(),
                            $date->copy()->addMonths($i)->endOfMonth()->toDateTimeString()
                        ])
                        ->count();
                }
                $lengthData = $dates;
                $totalData = $total;
                $successData = $success;
                $failedData = $failed;
                break;
        }

        return response()->json(array($lengthData, $totalData, $successData, $failedData));
    }
}
