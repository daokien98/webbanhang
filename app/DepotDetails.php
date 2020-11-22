<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepotDetails extends Model
{
    public $timestamps = false;
    protected $fillable = ['product_id','product_quantity','created_at'];
    protected $primaryKey = 'details_id';
    protected $table = 'tbl_depot_details';

    public function product_depot(){
    	return $this->belongsTo('App\Product','product_id');
    }
}
