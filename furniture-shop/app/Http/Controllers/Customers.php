<?php

namespace FurnitureShop\Http\Controllers;
use Illuminate\Http\Request;
use FurnitureShop\Http\Requests;
use FurnitureShop\Customer;

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

        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->street = $request->input('street');
        $customer->suburb = $request->input('suburb');
        $customer->municipality = $request->input('municipality');
        $customer->state = $request->input('state');
        $customer->rfc = $request->input('rfc');
        $customer->house_number = $request->input('house_number');
        $customer->phone_number = $request->input('phone_number');
        $customer->save();

        return 'Cliente creado exitosamente con id ' . $customer->id;
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

        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->street = $request->input('street');
        $customer->suburb = $request->input('suburb');
        $customer->municipality = $request->input('municipality');
        $customer->state = $request->input('state');
        $customer->rfc = $request->input('rfc');
        $customer->house_number = $request->input('house_number');
        $customer->phone_number = $request->input('phone_number');
        $customer->save();

        return "Cliente editado correctamente #" . $customer->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
       
        $customer = Customer::find($request->input('id'));
        $customer->delete();

        return "Customer eliminado correctamente #" . $request->input('id');
    }
} 