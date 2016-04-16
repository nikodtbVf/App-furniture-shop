<?php

namespace FurnitureShop;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = array('id','interests','initialpay','numbers_months');
}
