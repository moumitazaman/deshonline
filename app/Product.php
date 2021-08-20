<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'product_name','quantity','category','price','points','img_name','galleryimages'
    ];
    protected $casts = [
        
        'galleryimages' => 'json',
        
    ];
}
