<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Services\LoanService;
use App\Services\SpotMarketOrderService;
use App\SpotMarket;
use App\SpotMarketCart;
use App\SpotMarketOrder;
use App\SpotMarketPayment;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpotMarketController extends Controller
{
    /**
     * @var SpotMarketOrderService
     */
    private $spotMarketOrderService;

    /**
     * @var LoanService
     */
    public function __construct(SpotMarketOrderService $spotMarketOrderService)
    {
        $this->spotMarketOrderService = $spotMarketOrderService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        $cart = SpotMarket::
            join('spot_market_carts', 'spot_market_carts.spot_market_id','=','spot_markets.id')
            ->where('user_id', auth()->user()->id)
            ->select(
                'spot_markets.*',
                'spot_market_carts.id as cart_id',
                'spot_market_carts.quantity'
            )
            ->get();
        return view(subDomainPath('spot-market.cart'), compact('cart'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myOrders()
    {
        $orders = SpotMarket::
            join('spot_market_orders', 'spot_market_orders.spot_market_id','=','spot_markets.id')
            ->where('user_id', auth()->user()->id)
            ->select(
                'spot_markets.*',
                'spot_market_orders.id as order_id',
                'spot_market_orders.id as cart_id',
                'spot_market_orders.order_number',
                'spot_market_orders.price as order_price',
                'spot_market_orders.quantity as order_quantity',
                'spot_market_orders.sub_total as order_subtotal',
                'spot_market_orders.created_at as order_placed'
            )
            ->orderBy('spot_market_orders.created_at','desc')
            ->get()
            ->groupBy('order_number');
        return view(subDomainPath('spot-market.my_orders'), compact('orders'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {

        $array = [
            'user_id' => auth()->user()->id,
            'spot_market_id' => $request->id
        ];
        $cart = SpotMarketCart::firstOrNew($array);
        $cart->quantity = $cart->quantity + 1;
        $cart->save();
        return getUserSpotMarketCartCount();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $spotMarketList = [];

        $roleName = auth()->user()->roles->first()->name;
        $isCommunityLeader = false;
        if($roleName == 'farmer'){
            if(isCommunityLeader()){
                $spotMarketList = auth()->user()->farmer->spotMarket;
                $isCommunityLeader = true;
                return view(subDomainPath('spot-market.index'), compact('spotMarketList', 'isCommunityLeader'));
            }else{
                $spotMarketList = SpotMarket::all();
                return view(subDomainPath('spot-market.browse'), compact('spotMarketList', 'isCommunityLeader'));
            }
        }else{
            $spotMarketList = SpotMarket::all();
            return view(subDomainPath('spot-market.browse'), compact('spotMarketList', 'isCommunityLeader'));
        }
;

        return view(subDomainPath('spot-market.index'), compact('spotMarketList', 'isCommunityLeader'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(subDomainPath('spot-market.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roleName = auth()->user()->roles->first()->name;
        $array = $request->except('_token');
        if($roleName == 'farmer'){
            $farmerModel = auth()->user()->farmer;

            $array = array_merge($array,[
                'model_id' => $farmerModel->id,
                'model_type' => 'App\Farmer',
            ]);
            $array["original_price"] = preg_replace('/,/','', $array['original_price']);
            $array["selling_price"] = preg_replace('/,/','', $array['selling_price']);
            $spotMarket = SpotMarket::create($array);
            $spotMarket->addMedia($request->file('image'))
                ->toMediaCollection('spot-market');
            $farmerModel->spotMarket()->save($spotMarket);
        }

        return redirect()->route('spot-market.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = SpotMarket::find($id);
        return view(subDomainPath('spot-market.show'), compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SpotMarket::find($id);
        return view(subDomainPath('spot-market.edit'), compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = SpotMarket::find($id);
        $data->update($request->except(['_token', 'image']));
        if($request->hasFile('image')){
            $media = $data->getFirstMedia('spot-market');
            if($media){
                $media->delete();
            }
            $data->addMedia($request->file('image'))->toMediaCollection('spot-market');
        }

        return redirect()->back();
    }

    public function destroy()
    {
        //
    }

    public function lockInOrder(Request $request)
    {

        $formStringify = $request->input('form');
        $form = json_decode($formStringify,true);
        DB::beginTransaction();
        $orderNumber = sprintf('%08d', SpotMarketOrder::count()+1);
        foreach($form as $row){
            $spotMarketOrder = new SpotMarketOrder();
            $spotMarketOrder->order_number = $orderNumber;
            $spotMarketOrder->spot_market_id = $row['id'];
            $spotMarketOrder->user_id = auth()->user()->id;
            $spotMarketOrder->quantity = $row['qty'];
            $spotMarketOrder->price = $row['price'];
            $spotMarketOrder->sub_total = $row['sub_total'];
            if($spotMarketOrder->save()){
                $cart = SpotMarketCart::find($row['cart_id']);
                if($cart){
                    $cart->delete();
                    $this->spotMarketOrderService->newOrder($spotMarketOrder);
                }else{
                }
            }else{
            }
        }

        DB::commit();

    }

    public function verifyPayment(Request  $request)
    {
        $request->validate([
            'proof_of_payment' => 'max:10000',
        ],[
            'proof_of_payment.max' => 'Proof of Payment Must be less than 10MB'
        ]);

        $orders = SpotMarketOrder::where('order_number', $request->order_number)->first();
        if($orders){
            $payment = new SpotMarketPayment();
            $payment->order_number = $request->order_number;
            $payment->payment_date = $request->paid_date;
            $payment->reference_number = $request->reference_number;
            $payment->save();
            $payment->addMedia($request->file('proof_of_payment'))
                ->toMediaCollection('spot-market-proof-payment');

            $this->spotMarketOrderService->verified($orders);

        }
        return redirect()->back()->with('success','Payment Verified!');
    }

}
