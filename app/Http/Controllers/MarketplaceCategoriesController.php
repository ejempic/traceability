<?php

namespace App\Http\Controllers;

use App\Farmer;
use App\Inventory;
use App\Loan;
use App\LoanProvider;
use App\LoanType;
use App\MarketPlace;
use App\MarketplaceCategories;
use App\MarketplaceOrder;
use App\Services\MarketplaceOrderService;
use App\Trace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MarketplaceCategoriesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = MarketplaceCategories::get();
        return view('admin.settings.marketplace_categories', compact( 'categories'));
    }


    public function list()
    {
        $categories = MarketplaceCategories::with('media','parentCat','childrenCat')->get();
        return $categories;
    }

    public function edit(Request $request)
    {
        $categories = MarketplaceCategories::find($request->id);

        $mpc_slug = stringSlug($request->name);
        $mpc_existing_count = MarketplaceCategories::where('name', stringSlug($request->name))->count();
        if($mpc_existing_count > 0){
            $mpc_slug.=$mpc_existing_count;
        }
        $mpc = $categories->update([
            'parent_id' => $request->parent_id,
            'name' => $mpc_slug,
            'display_name' => $request->name,
        ]);

        if($request->hasFile('image')){
//            $media = $mpc->getFirstMedia('logo');
//            if($media){
            $mpc->clearMediaCollection();
//            }
            $mpc->addMedia($request->file('image'))
                ->toMediaCollection('logo');
        }

        return redirect()->back()->with('success','Successfully Updated!');
    }

    public function delete(Request $request)
    {
        $categories = MarketplaceCategories::find($request->id);

        $categories->delete();
        return 1;
    }

    public function store(Request $request)
    {
        $mpc_slug = stringSlug($request->name);
        $mpc_existing_count = MarketplaceCategories::where('name', stringSlug($request->name))->count();
        if($mpc_existing_count > 0){
            $mpc_slug.=$mpc_existing_count;
        }
        $mpc = MarketplaceCategories::create([
            'parent_id' => $request->parent_id,
            'name' => $mpc_slug,
            'display_name' => $request->name,
        ]);

        if($request->hasFile('image')){
            $mpc->addMedia($request->file('image'))
                ->toMediaCollection('logo');
        }


        return redirect()->back()->with('success','Successfully Added!');
    }

}
