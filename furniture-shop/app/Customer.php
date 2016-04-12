<?php

namespace FurnitureShop;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = array('id', 'name', 'email','street','suburb','municipality','state','rfc','house_number','phone_number');
}
