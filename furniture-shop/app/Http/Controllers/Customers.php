<?php

namespace FurnitureShop\Http\Controllers;
use Illuminate\Http\Request;
use FurnitureShop\Http\Requests;
use FurnitureShop\Customer;
use Log;
class Customers extends Controller
{
   
	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            return Customer::orderBy('id', 'asc')->get();
        } else {
            return $this->show($id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
     
      
        $customer = new Customer;

        $customer->name = $request['name'];
        $customer->email = $request['email'];
        $customer->street = $request['street'];
        $customer->suburb = $request['suburb'];
        $customer->municipality = $request['municipality'];
        $customer->state = $request['state'];
        $customer->rfc = $request['rfc'];
        $customer->house_number = $request['house_number'];
        $customer->phone_number = $request['phone_number'];
        $customer->save();

        return "Cliente creado existosamente!";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return Customer::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $customer = Customer::find($id);

        $customer->name = $request['name'];
        $customer->email = $request['email'];
        $customer->street = $request['street'];
        $customer->suburb = $request['suburb'];
        $customer->municipality = $request['municipality'];
        $customer->state = $request['state'];
        $customer->rfc = $request['rfc'];
        $customer->house_number = $request['house_number'];
        $customer->phone_number = $request['phone_number'];
        $customer->save();
    
        return "Cliente editado correctamente";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request,$id) {
       
        $customer = Customer::find($id);
        $customer->delete();
        return "Cliente eliminado correctamente #";
    }
} 