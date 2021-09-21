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
        'dob',
        'civil_status',
        'gender',
        'landline',
        'mobile',
        'tin',
        'sss_gsis',
        'education',
        'image',
        'secondary_info',
        'spouse_comaker_info',
        'farming_info',
        'employment_info',
        'income_asset_info',
        'qr_image',
        'qr_image_path',
        'status',
        'designation',
        'bank_name',
        'branch_name',
        'branch_code',
        'branch_address',
        'contact_person',
        'contact_designation',
        'contact_number'
    ];

    protected $appends = [
        'bday'
    ];

    public function info()
    {
        return $this->morphTo();
    }

    public function getBdayAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->toFormattedDateString();
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
