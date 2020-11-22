<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timestamps = false;
    protected $fillable = ['order_code','product_id','product_id','product_price','product_sales_quantity','product_coupon','product_fee'];
    protected $primaryKey = 'order_details_id';
    protected $table = 'tbl_order_details';

    public function product(){
    	return $this->belongsTo('App\Product','product_id');
    }
}
