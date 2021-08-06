<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class SpotMarket extends Model implements HasMedia
{
    use HasMediaTrait;
    //
    protected $fillable = [
       ' model_id',
       ' model_type',
        'name',
        'description',
        'original_price',
        'selling_price',
        'status',
    ];
}
