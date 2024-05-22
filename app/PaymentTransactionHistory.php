<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

class PaymentTransactionHistory extends Model
{

    protected $table = 'payment_transactions_history';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];

}
