<?php

namespace FurnitureShop\Http\Controllers;

use Illuminate\Http\Request;

use FurnitureShop\Http\Requests;
use FurnitureShop\Sale;
use FurnitureShop\Product;
use FurnitureShop\Configuration;
class Sales extends Controller
{
    //Initialize the variable configuration that obtains values of current configuration(interests,initialpay..etc..)

	protected $configuration;
    protected $actualProduct;

    public function index($id = null) {
        $this->getConfigData();
        if ($id == null) {
            return Sale::orderBy('id', 'asc')->get();
        } else {
            return $this->show($id);
        }
    }

    public function store(Request $request) {

        $this->getConfigData();
        $quantity = $request['quantity'];
        $id_product = $request['product_id'];
        
        //Check if product is available 

        $isAvailable = $this->getAvailability($quantity,$id_product);
               
        if($isAvailable){
            
            //obtain the data necessary to make the sale
            $price = $this->actualProduct->price;
            $rateinterests = $this->configuration->interests;
            $payment_months = $this->configuration->numbers_months;
            $rateinterestsanual = $rateinterests*$payment_months/100;

            //Create a sale 
            $sale = new Sale;
            $sale->customer_id = $request['customer_id'];
            $sale->product_id = $request['product_id'];
            $sale->quantity = $quantity;
            $sale->interests = ($price*$rateinterestsanual)*$quantity;
            $sale->subtotal = $quantity*$price;
            $sale->total = $sale->interests + $sale->subtotal; 
            //This data will calculate when user click give initial payment     
            $sale->realinitpay = 0;
            $sale->remaing = 0;
            $sale->remaing_interests = 0;
            $sale->save();

            return "Venta creada exitosamente";
        }else{
             return "No existen suficientes productos!";
        } 
    }

    public function getConfigData() {
    	$this->configuration  = Configuration::find(1);
    }   

    public function getAvailability($quantity,$id_product){

        $product =  Product::find($id_product);
        $stock = $product->stock; 

        //Save the product to use in store function
        $this->actualProduct = $product;
         
        if($stock >= $quantity ){
            return true;
        }else{
            return false;
        }
    }
}