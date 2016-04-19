<?php

namespace FurnitureShop\Http\Controllers;

use Illuminate\Http\Request;
use FurnitureShop\Http\Requests;
use FurnitureShop\Sale;
use FurnitureShop\Product;
use FurnitureShop\Customer;
use FurnitureShop\Configuration;


class Sales extends Controller
{
    

	protected $configuration;
    protected $product;
    protected $customer;

    public function index($id = null) {
        
        $this->getConfigData();
        if ($id == null) {
           
            $sales = Sale::All();
            $length = count($sales);

            //Get the name of the customer and current product
            for($i=0; $i<$length; $i++){
                $sale = $sales[$i];
                $this->getCustomerProduct($sale);
                $sale->customer = $this->customer->name;
                $sale->product = $this->product->name;
            } 
            return $sales;
        } else {
            return $this->show($id);
        }
    }

    public function store(Request $request) {

        $this->getConfigData();

        $quantity = $request['quantity'];
        $id_product = $request['product_id'];
        
        //Check if product is available(depends of stock) 
        $isAvailable = $this->isAvailability($quantity,$id_product);       
        
        if($isAvailable){
            
            //obtain the data necessary to make the sale
            $price = $this->product->price;
            $rateinterestsanual = $this->configuration->rateinterestsanual;
            
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
    
    public function show($id){

        $sale = Sale::find($id);
        $this->getConfigData();
        $this->getCustomerProduct($sale);
       
        //Add data customer to show in report
        $sale->name = $this->customer->name;
        $sale->street = $this->customer->street;
        $sale->suburb = $this->customer->suburb;
        $sale->municipality = $this->customer->municipality;
        $sale->state = $this->customer->state;
        $sale->rfc = $this->customer->rfc;
        
        //Add data product to show in report
        $sale->name_product = $this->product->name;
        $sale->description = $this->product->description;
        $sale->model = $this->product->model;
        $sale->price = $this->product->price;
        $sale->numbers_months = $this->configuration->numbers_months;
        
        //Calculate the initial pay, bonus, and real total 
        $firstpay = $this->configuration->initialpay;
        $sale->firstpay = ($sale->total * $firstpay)/100;
        $rateinterestsanual = $this->configuration->rateinterestsanual;
        $sale->bonus = $sale->firstpay * $rateinterestsanual;

        return $sale;
    }

    //This function get the anual rate to pay by customer
    public function getConfigData() {
    	$this->configuration  = Configuration::find(1);
        $rateinterests = $this->configuration->interests;
        $payment_months = $this->configuration->numbers_months;
        $this->configuration->rateinterestsanual = $rateinterests*$payment_months/100;
    }   
   
    public function isAvailability($quantity,$id_product){

        $product =  Product::find($id_product);
        $stock = $product->stock; 

        //Save the product to use in store function
        $this->product = $product;
         
        if($stock >= $quantity ){
            /*  decrease the stock
                $remainproducts = $stock - $quantity;
                $product->stock = $remainproducts;
                $product.save();
            */

            return true;
        }else{
            return false;
        }
    }

    //Function to obtain the customer and product to current sale
    public function getCustomerProduct ($sale){
        
        $idcustomer = $sale->customer_id;
        $customer =Customer::find($idcustomer);
        $this->customer = $customer;

        //Find name to producto by id
        $idproduct = $sale->product_id;
        $product = Product::find($idproduct);
        $this->product = $product;
    }


}