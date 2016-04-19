<?php

namespace FurnitureShop\Http\Controllers;
use Illuminate\Http\Request;
use FurnitureShop\Http\Requests;
use FurnitureShop\Customer;

class Customers extends Controller
{
   
    protected $customer;

    public function index($id = null) {
        if ($id == null) {
            return Customer::orderBy('id', 'asc')->get();
        } else {
            return $this->show($id);
        }
    }

    public function store(Request $request) {

        $customer = new Customer;
        $this->getCustomer($request,$customer);
        $customer = $this->customer;
        $customer->save();
        return "Cliente creado existosamente!";
    }


    public function show($id) {
        return Customer::find($id);
    }

    
    public function update(Request $request, $id) {
        
        $customer = Customer::find($id);
        $this->getCustomer($request,$customer);
        $customer = $this->customer;
        $customer->save();
    
        return "Cliente editado correctamente";
    }

    public function destroy(Request $request,$id) {
       
        $customer = Customer::find($id);
        $customer->delete();
        return "Cliente eliminado correctamente";
    }

    //Get data's customer from request
    public function getCustomer(Request $request,$customer){

        $customer->name = $request['name'];
        $customer->email = $request['email'];
        $customer->street = $request['street'];
        $customer->suburb = $request['suburb'];
        $customer->municipality = $request['municipality'];
        $customer->state = $request['state'];
        $customer->rfc = $request['rfc'];
        $customer->house_number = $request['house_number'];
        $customer->phone_number = $request['phone_number'];
        $this->customer = $customer;
    }
} 