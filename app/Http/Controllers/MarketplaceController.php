<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Inventory;
use App\Loan;
use App\LoanProvider;
use App\LoanType;
use App\MarketPlace;
use App\MarketplaceOrder;
use App\Services\MarketplaceOrderService;
use App\Trace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketplaceController extends Controller
{
    /**
     * @var MarketplaceOrderService
     */
    private $marketplaceOrderService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarketplaceOrderService $marketplaceOrderService)
    {
        $this->middleware('auth');
        $this->marketplaceOrderService = $marketplaceOrderService;
    }

    public function orders()
    {
        $orders = MarketplaceOrder::with('user','payment','items.product')
            ->orderBy('created_at','desc')
            ->get();

//        return $orders;

        return view('wharf.market-place.orders', compact( 'orders'));

    }

    public function approve(Request  $request)
    {
        $marketplaces = MarketplaceOrder::find($request->id);

        $this->marketplaceOrderService->approved($marketplaces);

        return redirect()->back()->with('success','Successfully approved!');

    }

    public function deliver(Request  $request)
    {
        $marketplaces = MarketplaceOrder::find($request->id);

        $this->marketplaceOrderService->delivery($marketplaces);

        return redirect()->back()->with('success','Successfully change status to delivery!');

    }

    public function delivered(Request  $request)
    {
        $marketplaces = MarketplaceOrder::find($request->id);

        $this->marketplaceOrderService->delivered($marketplaces);

        return redirect()->back()->with('success','Successfully change status to delivered! Thank you!');

    }

}
