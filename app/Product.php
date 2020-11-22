<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = ['product_name','category_id','brand_id','product_price','product_cost','product_image','product_status','product_content','product_note','product_tags','product_sold','product_depot','product_depot_time','product_views'];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function comment(){
    	return $this->hasMany('App\Comment');
    }

    public function brand(){
    	return $this->belongsTo('App\Brand','product_id');
    }

    public function category(){
    	return $this->belongsTo('App\Category','category_id');
    }

}
