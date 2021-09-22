<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanApplicationDetail extends Model
{
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
    public function getincomeAssetInfoAttribute($value)
    {
        return unserialize($value);
    }
    public function getInfoLoanDetailAttribute($value)
    {
        return unserialize($value);
    }
    public function getCreditFinancialInfoAttribute($value)
    {
        return unserialize($value);
    }
    public function getTradeReferenceInfoAttribute($value)
    {
        return unserialize($value);
    }
    public function getReferenceIdAttribute($value)
    {
        return unserialize($value);
    }
}
