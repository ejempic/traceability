<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
    protected $fillable = [
        "loan_provider_id",
        "name",
        "loan_type",
        "description",
        "amount",
        "duration",
        "interest_rate"
    ];

    public function provider()
    {
        return $this->belongsTo(LoanProvider::class, 'loan_provider_id');
    }
}
