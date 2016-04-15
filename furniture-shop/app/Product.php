<?php

namespace FurnitureShop;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = array('id','name','description','stock','price');
}
