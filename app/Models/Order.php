<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['no','user_id','total_amount','paid_at','payment_method','payment_no'];

}
