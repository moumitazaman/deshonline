<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAtributes extends Model
{
    protected $table = "productattributes";
    protected $primaryKey = 'id';
    protected $fillable = ['attr_id','details','selectval'];
    protected $casts = [
        
        'attr_id' => 'json',
        'details' => 'json',
        'selectval' => 'json'
    ];
}
