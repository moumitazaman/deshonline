<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = "product_details";
    protected $primaryKey = 'id';
    protected $fillable = ['product_id','status'];

}
