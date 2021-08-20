<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = "product_sales";
    protected $primaryKey = 'id';
}
