<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanCollection;
use App\Loan;
use App\LoanPayment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::where('borrower_type', 'App\Farmer')
            ->where('borrower_id', Auth::user()->farmer->id)
            ->get();

        return view(subDomainPath('farmer.loans.index'), compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify(Request  $request)
    {

        $filename = Storage::disk('payment_proof')->put($request->loan_id, $request->proof_of_payment);
        $url = Storage::disk('payment_proof')->url($filename);

        $loan = new LoanPayment();
        $loan->loan_id = $request->loan_id;
        $loan->payment_method = $request->payment_method;
        $loan->paid_amount = preg_replace('/,/','',$request->paid_amount);
        $loan->paid_date = $request->paid_date;
        $loan->proof_of_payment = $url;
        $loan->reference_number = $request->reference_number;
        $loan->save();
        dd($loan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function proofPhoto(Request $request,$id, $proof)
    {
        $url = Storage::disk('payment_proof')
            ->get('/'. $id.'/'.$proof);
        $type = $request->type;
        if($type == 'view'){
            return response()->file(storage_path('app/payment_proof/').$id.'/'.$proof);
        }
        if($type == 'download'){
            return response()->download(storage_path('app/payment_proof/').$id.'/'.$proof);
        }
        return $url;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }

//    public function loanList()
//    {
//
//    }
}
