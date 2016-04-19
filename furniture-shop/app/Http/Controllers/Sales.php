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
    //Initialize the variable configuration that obtains values of current configuration(interests,initialpay..etc..)

	protected $configuration;
    protected $product;
    protected $customer;
    protected $actualProduct;

    public function index($id = null) {
        $this->getConfigData();
        if ($id == null) {
           
            $sales = Sale::All();
            $longitud = count($sales);
             
            for($i=0; $i<$longitud; $i++){
                $sale = $sales[$i];
                $this->getCustomerProduct($sale);
                $sale->customer = $this->customer;
                $sale->product = $this->product;
            } 
            return $sales;
        } else {
            return $this->show($id);
        }
    }

    public function setConfigPayment(){
       $rateinterests = $this->configuration->interests;
       $payment_months = $this->configuration->numbers_months;
       $this->configuration->rateinterestsanual = $rateinterests*$payment_months/100;
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

            $this->setConfigPayment();
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
        $this->getConfigData();
        $this->setConfigPayment();
        $sale = Sale::find($id);
        //Find customer
        $idcustomer = $sale->customer_id;
        $customer =Customer::find($idcustomer);
        //Find product 
        $idproduct = $sale->product_id;
        $product = Product::find($idproduct);

        //Add data to show in report
        $sale->name = $customer->name;
        $sale->street = $customer->street;
        $sale->suburb = $customer->suburb;
        $sale->municipality = $customer->municipality;
        $sale->state = $customer->state;
        $sale->rfc = $customer->rfc;
        
        //Add data product to show in report
        $sale->name_product = $product->name;
        $sale->description = $product->description;
        $sale->model = $product->model;
        $sale->price = $product->price;
        $sale->numbers_months = $this->configuration->numbers_months;
        
        //Calculate the initial pay, bonus, and real total 
        $firstpay = $this->configuration->initialpay;
        $sale->firstpay = ($sale->total * $firstpay)/100;
        $rateinterestsanual = $this->configuration->rateinterestsanual;
        $sale->bonus = $sale->firstpay * $rateinterestsanual;

        return $sale;
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

    public function getCustomerProduct ($sale){
        $idcustomer = $sale->customer_id;
        $customer =Customer::find($idcustomer);
        $this->customer = $customer->name;

        //Find name to producto by id
        $idproduct = $sale->product_id;
        $product = Product::find($idproduct);
        $this->product = $product->name;
    }

    public function update (Request $request,$id){
     
    }
}