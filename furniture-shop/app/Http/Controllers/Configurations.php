<?php

namespace FurnitureShop\Http\Controllers;

use Illuminate\Http\Request;

use FurnitureShop\Http\Requests;
use FurnitureShop\Configuration;
class Configurations extends Controller
{
    public function index($id = null) {
        if ($id == null) {
            return Configuration::orderBy('id', 'asc')->get();
        } else {
            return $this->show($id);
        }
    }

     public function show($id) {
        return Configuration::find($id);
    }

    public function update(Request $request, $id) {
        $configuration = Configuration::find($id);

        $configuration->interests = $request['interests'];
        $configuration->initialpay = $request['initialpay'];
        $configuration->numbers_months = $request['numbers_months'];
        $configuration->save();
    
        return "Configuracion editada";
    }

}
