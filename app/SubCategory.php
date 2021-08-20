<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
  protected $table = 'subcategory';

    public function category(){

    	return $this->belongsTo('App\Model\Category')->withDefault([
          'id' => 0,
          'category_name' => 'unknown', 
        ]);
        }
}
