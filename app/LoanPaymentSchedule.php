<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanPaymentSchedule extends Model
{
    //
    protected $fillable = [
        'loan_id',
        'due_date',
        'paid_date',
        'payable_amount',
        'paid_amount',
        'status',
    ];
}
