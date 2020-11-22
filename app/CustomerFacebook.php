<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerFacebook extends Model
{
    public $timestamps = false;
    protected $fillable = ['customer_email','customer_password','customer_name','customer_phone'];
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customer';
}
