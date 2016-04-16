<?php

namespace FurnitureShop;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
     protected $fillable = array('id', 'customer_id', 'product_id','quantity','realinitpay','interests','subtotal','total','realinitpay','remaing','remaing_interests');
}
