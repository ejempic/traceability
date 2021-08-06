<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoanCollection;
use App\Loan;
use App\LoanPayment;
use App\LoanPaymentSchedule;
use App\Services\LoanService;
use App\SpotMarket;
use App\SpotMarketCart;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class SpotMarketController extends Controller
{
    /**
     * @var LoanService
     */
    public function __construct()
    {

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
            }else{
                $spotMarketList = SpotMarket::all();
                return view(subDomainPath('spot-market.browse'), compact('spotMarketList', 'isCommunityLeader'));
            }
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
            $media->delete();
            $data->addMedia($request->file('image'))->toMediaCollection('spot-market');
        }

        return redirect()->back();
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
