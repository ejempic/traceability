<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_id',
        'model_type',
        'first_name',
        'middle_name',
        'last_name',
        'mobile',
        'address',
        'education',
        'four_ps',
        'pwd',
        'indigenous',
        'livelihood',
        'farm_lot',
        'farming_since',
        'organization',
        'status',
        'dob',
        'pob',
        'gender',
        'civil_status',
        'citizenship',
        'gross_monthly_income',
        'monthly_expenses',
    ];

    protected $appends = [
        'age'
    ];

    public function info()
    {
        return $this->morphTo();
    }

    public function getAgeAttribute($value)
    {
        return Carbon::parse($value)->diff(Carbon::now())->format('%y years, %m months and %d days');
    }

    public function getDobAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();
    }

    public function getSecondaryInfoAttribute($value)
    {
        return unserialize($value);
    }

    public function getSpouseComakerInfoAttribute($value)
    {
        return unserialize($value);
    }

    public function getFarmingInfoAttribute($value)
    {
        return unserialize($value);
    }

    public function getEmploymentInfoAttribute($value)
    {
        return unserialize($value);
    }

    public function getIncomeAssetInfoAttribute($value)
    {
        return unserialize($value);
    }
}
