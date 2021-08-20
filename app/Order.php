<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'order_number', 'user_id', 'status', 'total_amount', 'total_item', 'full_address', 'notes'
    ];

}
