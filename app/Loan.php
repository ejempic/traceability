<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function info()
    {
        return $this->morphTo();
    }

    public function product()
    {
        return $this->hasOne(LoanProduct::class, 'loan_product_id');
    }
}
