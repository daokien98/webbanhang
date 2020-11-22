<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['category_name','category_parent','meta_keywords','category_desc','category_price','category_producer','category_unit','slug_category_product'];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';

    public function product(){
    	return $this->hasMany('App\Product');
    }
}
