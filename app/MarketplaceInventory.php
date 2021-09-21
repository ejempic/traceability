<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketplaceInventory extends Model
{
    //
    protected $fillable = [
        'market_place_id',
        'quantity',
    ];
}
